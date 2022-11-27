<html>
    <h3>Student Login</h3>
    <form action="{{ route('login') }}" method="POST">
        <table>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="email" name="email">
                </td>
            </tr>
            <tr>
                <td>
                    Password: 
                </td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>
        </table>

        @csrf

        <button type="submit">Login</button>
    </form>
</html>