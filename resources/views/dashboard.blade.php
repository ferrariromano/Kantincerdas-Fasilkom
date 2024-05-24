<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>

    @if ($dashboardType === 'dashboard_a')
        <p>ngentod dasbord a.</p>
    @elseif ($dashboardType === 'dashboard_b')
        <p>ngentod dasbord b.</p>
    @endif


    <!-- Logout button -->
    <form action="{{ route('tenant.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
