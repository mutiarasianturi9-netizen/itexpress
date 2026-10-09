<!DOCTYPE html>
<html>
<head>
    <title>KangPanggilin</title>
</head>
<body>

<h2>KangPanggilin</h2>

<nav>
    <a href="/">Beranda</a> |
    <a href="/services">Layanan</a> |

    @auth
        <a href="/logout">Logout</a>
    @else
        <a href="/login">Login</a>
    @endauth
</nav>

<hr>

<div>
    @yield('content')
</div>

</body>
</html>