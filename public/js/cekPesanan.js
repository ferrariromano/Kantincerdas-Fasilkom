document.addEventListener('DOMContentLoaded', function() {
    const orderStatusElements = document.querySelectorAll('.orderStatus');
    const messageElement = document.querySelector('.message');
    const statuses = [];

    // Collect statuses
    orderStatusElements.forEach(element => {
        statuses.push(element.textContent.trim().toLowerCase());
    });

    // Function to determine the message based on statuses
    function getMessage(statuses) {
        if (statuses.length === 1) {
            const status = statuses[0];
            if (status === 'pending') {
                return "Segera lakukan pembayaran agar pesananmu bisa segera diproses";
            } else if (status === 'in progress') {
                return "Pesanan sedang diproses, silakan tunggu hingga status pesanan menjadi \"Selesai\"";
            } else if (status === 'completed') {
                return "Pesanan selesai, segera ambil pesananmu di outlet terkait dan Selamat Menikmati :)";
            }
        } else if (statuses.length === 2) {
            const [status1, status2] = statuses;
            if (status1 === 'pending' && status2 === 'pending' ||
                status1 === 'in progress' && status2 === 'pending' ||
                status1 === 'pending' && status2 === 'in progress') {
                return "Segera lakukan pembayaran agar pesananmu bisa segera diproses";
            } else if (status1 === 'in progress' && status2 === 'in progress') {
                return "Pesanan sedang diproses, silakan tunggu hingga status pesanan menjadi \"Completed\"";
            } else if ((status1 === 'completed' && status2 === 'in progress') ||
                       (status1 === 'completed' && status2 === 'pending') ||
                       (status1 === 'in progress' && status2 === 'completed') ||
                       (status1 === 'pending' && status2 === 'completed')) {
                return "Ada pesanan yang selesai, segera ambil pesananmu di outlet terkait";
            } else if (status1 === 'completed' && status2 === 'completed') {
                return "Seluruh pesananmu sudah selesai, Segera ambil pesananmu di outlet terkait dan Selamat Menikmati :)";
            }
        }
        return "Segera lakukan pembayaran agar pesananmu bisa segera diproses";
    }

    // Update the message
    const message = getMessage(statuses);
    messageElement.textContent = message;

    // Function to format seconds to minutes and seconds
    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${mins} menit ${secs} detik`;
    }

    // Countdown timer functionality
    const countdownElements = document.querySelectorAll('.countdown');
    countdownElements.forEach(element => {
        const tenantId = element.closest('.outlet').dataset.tenantId;
        const initialRemainingTime = parseInt(element.dataset.remainingTime, 10);

        // Retrieve the stored remaining time from localStorage, if it exists
        let timeLeft = localStorage.getItem(`countdown_remaining_${tenantId}`);

        if (timeLeft === null) {
            // If no stored time is found, use the initial remaining time
            timeLeft = initialRemainingTime;
        } else {
            // Convert the stored time to an integer
            timeLeft = parseInt(timeLeft, 10);
        }

        if (timeLeft > 0) {
            const intervalId = setInterval(() => {
                timeLeft--;
                element.textContent = formatTime(timeLeft);

                if (timeLeft <= 0) {
                    clearInterval(intervalId);
                    localStorage.removeItem(`countdown_remaining_${tenantId}`);
                    window.location.reload();
                } else {
                    localStorage.setItem(`countdown_remaining_${tenantId}`, timeLeft);
                }
            }, 1000);
        } else {
            localStorage.removeItem('countdown_remaining_1');
            localStorage.removeItem('countdown_remaining_2');
            window.location.reload();
        }
    });

    //Cancel order functionality
    const cancelOrderButton = document.getElementById('cancelOrderButton');
    if (cancelOrderButton) {
        cancelOrderButton.addEventListener('click', function() {
            const orderId = cancelOrderButton.getAttribute('data-order-id');
            if (confirm('Apakah Anda yakin ingin membatalkan pesanan?')) {
                fetch(`/cancel-order/${orderId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        localStorage.removeItem('countdown_remaining_1');
                        localStorage.removeItem('countdown_remaining_2');
                        window.location.reload();
                    } else {
                        alert('Gagal membatalkan pesanan. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
            }
        });
    }

    // Remove countdown from localStorage if status is "In Progress"
    const removeCountdownForInProgressOrders = () => {
        document.querySelectorAll('.outlet').forEach(outlet => {
            const tenantId = outlet.dataset.tenantId;
            const status = outlet.querySelector('.orderStatus').textContent.trim().toLowerCase();
            if (status === 'in progress') {
                localStorage.removeItem(`countdown_remaining_${tenantId}`);
            }
        });
    };
    removeCountdownForInProgressOrders();

    // Refresh the page every 10 minutes
    function refreshPage() {
        setTimeout(function() {
            window.location.reload();
        }, 600000); // 600000 milliseconds = 10 minutes
    }

    // Call the refreshPage function
    refreshPage();
});
