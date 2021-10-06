<?php $this->layout('layouts::website');?>

<h3>Inschrijven</h3>

<p>Schrijf u snel in om gebruik te maken van de fantastische features</p>

<form action="<?php echo url("register.handle")?>" method="POST">
    <div class="forn-group">
        <label for ="email">Email</label>
        <input type="email" name="email" value="" class="form-control" id="email" aria-describedy="emailHelp">
        <small id="emailHelp" class="form-text text-muted">We delen uw e-mail adres met niemand, uw gegevens zijn veilig!</small>
    </div>
    <div class="form-group">
        <label for="wachtwoord">Wachtwoord</label>
        <input type="password" name="wachtwoord" class="form-control" id="wachtwoord">
    </div>
    <button type="submit" class="btn btn-primary">Registreren</button>
</form>