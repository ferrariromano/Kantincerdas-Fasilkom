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
});
