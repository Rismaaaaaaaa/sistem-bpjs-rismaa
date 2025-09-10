<form method="post" action="/register">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <select name="role">
        <option value="admin">Admin</option>
        <option value="superadmin">Super Admin</option>
    </select><br>
    <button type="submit">Register</button>
</form>
