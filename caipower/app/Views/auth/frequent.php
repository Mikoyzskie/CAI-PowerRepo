<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('public/assets/css/frequent.css');?>">
    <link rel="icon" href="https://i.imgur.com/mr6sxQf.png">
    <title>Frequently Asked Questions</title>
    <style>

    </style>
</head>
<body>
<div class="container">
  <h1 class="section__headline">FAQs</h1>
  <h2 class="c-faqs__headline">Initial Setup</h2>
  <ul class="c-faqs">
    <li class="c-faq c-faq--active">
      <span class="c-faq__title">Didn't get email activation link?</span>
      <div class="c-faq__answer">The email you registered with might have some typographical errors on it, so be careful next time. Email us @ caipower05@gmail.com with a subject 'EMAIL ACTIVATION ERROR' if this error persists. <br><br>Check your internet connection whether it is stable or not before proceeding to registration.<br> <br>You can resubmit a registration <a href="<?= base_url('auth/register')?>">here</a>.</div>
    </li>
    <li class="c-faq">
      <span class="c-faq__title">What if email activation link expires?</span>
      <div class="c-faq__answer">Activation links sent to any email address expires in the span of 1 hour (60 minutes), make sure to use the link immediately to avoid this kind of error. <br><br><a href="<?= base_url();?>">Click here!</a> to get check your email and get another activation link.</div>
    </li>
    <li class="c-faq">
      <span class="c-faq__title">What if email activation link is not working?</span>
      <div class="c-faq__answer">Activation links are disabled after they are used by the user to avoid multiple activation request to your account.<br><br>Check your account whether your account is activated or not in the login page and start your CAI Power journey.<br><br>You can log in <a href="<?= base_url('auth/')?>">here</a>!</div>
    </li>
  </ul>  <!-- /end c-faqs -->
  
    <h2 class="c-faqs__headline">Authentication Problems</h2>
  <ul class="c-faqs">
    <li class="c-faq">
      <span class="c-faq__title">Didn't receive password reset link?</span>
      <div class="c-faq__answer">Forgot Password? Password reset links are sent to the email you given if the email account exists in the system. <br><br>Check your the email inbox in spam if you think your email is correct. <br><br>You can send another request of password reset link <a href="<?= base_url('auth/reset');?>">here</a>.</div>
    </li>
    <li class="c-faq">
      <span class="c-faq__title">What if password reset link expires?</span>
      <div class="c-faq__answer">Password reset links sent to any email address expires in the span of 1 hour (60 minutes), make sure to use the link immediately to avoid this kind of error. <br><br>You can send another request of password reset link <a href="<?= base_url('auth/reset');?>">here</a>.
</div>
    </li>
    <li class="c-faq">
      <span class="c-faq__title">What to do if account is locked?</span>
      <div class="c-faq__answer">As a security measure, the system restricts multiple incorrect login attempt. 3 incorrect login attempts locks the account. <br><br>You can email us @ caipower05@gmail.com with a subject 'ACCOUNT UNLOCK' with a message request to manage this issue.</div>
    </li>
    <li class="c-faq">
      <span class="c-faq__title">What to do if account is archived?</span>
      <div class="c-faq__answer">Archived accounts are accounts temporarily deleted from the system. <br><br> You can email us @ caipower05@gmail.com with a subject 'ACCOUNT UNLOCK' with a message request to manage this issue.</div>
    </li>
    <li class="c-faq c-faq">
      <span class="c-faq__title">What to do if account not exist after successful registration?
      </span>
      <div class="c-faq__answer">Though it is unlikely to happen, contact us at caipower05@gmail.com with a subject 'ACCOUNT REGISTRATION' with your message request. <br><br>You can also submit another registration <a href="<?= base_url('auth/register')?>"></a></div>
    </li>
  </ul>  <!-- /end c-faqs -->
  
    <h2 class="c-faqs__headline">Other questions</h2>
  <ul class="c-faqs">
    <li class="c-faq">
      <span class="c-faq__title">Didn't receive new email confirmation link?</span>
      <div class="c-faq__answer">We never use chocolate left over from other rentals. We are more than happy to leave you with any chocolate left at the end of your rental if suitable bowls are provided.

</div>
    </li>
    <li class="c-faq">
      <span class="c-faq__title">What if new email confirmation link expires?</span>
      <div class="c-faq__answer">Activation links sent to any email address expires in the span of 1 hour (60 minutes), make sure to use the link immediately to avoid this kind of error. <br><br>You can log in to your current account and submit new email. Just go to settings. Click Email Update. Type your desired email then update. Check your email for new email confirmation link.</div>
    </li>
    <li class="c-faq">
      <span class="c-faq__title">Is CAI PowerPoint free?</span>
      <div class="c-faq__answer">CAI Power is a non-profitable website that teaches basic to advanced Microsoft PowerPoint&trade; Presentation skills for any device.</div>
    </li>
  </ul>  <!-- /end c-faqs -->
  
<span class="c-note">Copyright &copy CAI Power 2021</span>
</div>
<script>
    $('body').delegate('.c-faq', 'click', function(){
  $('.c-faq').removeClass('c-faq--active');
  $(this).addClass('c-faq--active');
});
</script>
</body>
</html>