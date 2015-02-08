<div class="user-settings">
	<form method="post" action="<?php echo $url ?>" enctype="multipart/form-data">
		<input type="hidden" name="form" value="settings">

		<h2 class="section-title lightweight">Generella inställningar</h2>

		<table>

			<tr class="field">
				<td class="label">
					<label for="email-field">Video kvalitet:</label>
				</td>
				<td class="input">
					<div class="settings-switch">
						<div class="option low" data-value="low">Low</div>
						<div class="option medium" data-value="medium">Medium</div>
						<div class="option high" data-value="high">High</div>
						<input type="hidden" name="video-quality" value="<?php echo $general->videoQuality ?>">
					</div>
				</td>
			</tr>

			<tr class="field">
				<td class="label">
					<label for="email-field">Notiser:</label>
				</td>
				<td class="input">
					<div class="settings-switch">
						<div class="option low" data-value="true">On</div>
						<div class="option medium" data-value="false">Off</div>
						<input type="hidden" name="notifications" value="<?php echo $general->notifications ?>">
					</div>
				</td>
			</tr>
		</table>

		<h2 class="section-title lightweight">Redigera profil</h2>

		<table>

			<tr class="field">
				<td class="label">
					<label for="email-field">Email:</label>
				</td>
				<td class="input">
					<input type="text" id="email-field" name="email" value="<?php echo $profile->email ?>">
				</td>
			</tr>

			<tr class="field">
				<td class="label">
					<label for="firstname-field">Förnamn:</label>
				</td>
				<td class="input">
					<input type="text" id="firstname-field" name="firstname" value="<?php echo $profile->firstname ?>">
				</td>
			</tr>

			<tr class="field">
				<td class="label">
					<label for="lastname-field">Efternamn:</label>
				</td>
				<td class="input">
					<input type="text" id="lastname-field" name="lastname" value="<?php echo $profile->lastname ?>">
				</td>
			</tr>

			<tr class="field premium">
				<td class="label">
					<label for="title-field">Titel:</label>
				</td>
				<td class="input">
					<input type="text" id="title-field" name="title" value="<?php echo $profile->title ?>">
				</td>
			</tr>

		</table>

		<h2 class="section-title lightweight">Bilder</h2>
		<p class="form-hint">Om du laddar upp en ny bild kommer din gamla att ersättas.</p>
		<table>
			<tr class="field">
				<td class="label">
					<label for="profileimage-field">Profilbild:</label>
				</td>
				<td class="input">
					<input type="file" id="profileimage-field" name="profileimage" value="">
				</td>
			</tr>

		</table>

		<h2 class="section-title lightweight">Byt lösenord</h2>
		<p class="form-hint">Fyll endast i om du vill ändra ditt nuvarande lösenord</p>

		<table>

			<tr class="field">
				<td class="label">
					<label for="password-field">Lösenord:</label>
				</td>
				<td class="input">
					<input type="text" id="password-field" name="password" value="">
				</td>
			</tr>

			<tr class="field">
				<td class="label">
					<label for="passwordagain-field">Lösenord igen:</label>
				</td>
				<td class="input">
					<input type="text" id="passwordagain-field" name="passwordagain" value="">
				</td>
			</tr>

		</table>

		<button type="submit" class="button button-small">Spara</button>
	</form>
</div>