<!DOCTYPE html>
<html>
<head>
    <title>Tenant Login</title>
</head>
<body>
    <form method="POST" action="{{ route('tenant.login') }}">
        @csrf
        <div>
            <label for="nama_tenant">Nama Tenant:</label>
            <input type="text" id="nama_tenant" name="nama_tenant">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>
