<h1>Recuperação de senha</h1><br />
<br />Clique aqui para recuperar a sua senha: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
