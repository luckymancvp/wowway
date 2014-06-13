<?php
/*---------------------------------
	Template Name: Contact
------------------------------------*/
	get_header(); 
	
	$theme_options = get_option('option_tree');
	
?>

	<article id="contactDetails" class="clearfix">

		<header>
			<h4><?php get_option_tree('rb_form_title', $theme_options, true); ?></h4>
		</header>
		<hr class="first" />

		<ul class="contactIcons">

		<?php

			$phones= explode("<br />\r\n", nl2br(get_option_tree('rb_form_number_input', $theme_options)));

			$k = 0;
			if(strlen($phones[0]) > 1)
				foreach($phones as $phone)
					echo '<li class="phone' . ($k++ > 0 ? ' none' : '') . '"><a href="callto:' . str_replace(array('(', ')', '-', ' '), '', $phone) . '">' . $phone . '</a></li>';

			$emails = explode("<br />\r\n", nl2br(get_option_tree('rb_form_email_input', $theme_options)));

			$k = 0;
			if(strlen($emails[0]) > 1)
				foreach($emails as $email)
					echo '<li class="email' . ($k++ > 0 ? ' none' : '') . '"><a href="mailto:' . $email . '">' . $email . '</a></li>';

			echo '<li class="address">' . nl2br(get_option_tree('rb_form_address_input', $theme_options)) . '</li>';

		?>

		</ul>

		<h4>Write Us</h4>
		<hr />
		<form class="contactForm" id="contact" action="#">
			<input id="formName" type="text" value="<?php get_option_tree('rb_form_name_label', $theme_options, true); ?>" data-value="<?php get_option_tree('rb_form_name_label', $theme_options, true); ?>" />
			<input id="formEmail" type="text" value="<?php get_option_tree('rb_form_email_label', $theme_options, true); ?>" data-value="<?php get_option_tree('rb_form_email_label', $theme_options, true); ?>" />
			<textarea id="formMessage" cols="83" rows="4" data-value="<?php get_option_tree('rb_form_message_label', $theme_options, true); ?>"><?php get_option_tree('rb_form_message_label', $theme_options, true); ?></textarea>
			<div class="form-submit">
				<input id="submit" class="submit button small grey subtle" type="submit" value="<?php get_option_tree('rb_form_button_label', $theme_options, true); ?>" />
			</div>
			<p class="contactError"><?php get_option_tree('rb_form_error', $theme_options, true); ?></p>
		</form>

		<a href="#" class="actionButton minimize" data-content="#contactDetails" data-speed="300">minimize</a>

	</article>

<?php get_footer(); ?>