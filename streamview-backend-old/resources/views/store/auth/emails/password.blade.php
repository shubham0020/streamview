Click here to reset your password: <a href="{{ $link = url('/store/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
