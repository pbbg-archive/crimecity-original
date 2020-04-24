<?php
include 'header.php';
error_reporting(E_ALL);

?>
  
<tr>
<td class="contenthead">General Information</td>
</tr>
<table class="content">
<tr>

<table width='100%'>

<tr>
	<td width='15%'>Name:</td>
	<td width='35%'><?= ($user_class->rmdays >0) ? ' <a href="profiles.php?id='.$user_class->id.'"><img src="images/username/'.$user_class->id.'.png" style="height:17px" style="width:17px"></a>' : '<a href="profiles.php?id="'. $_SESSION['id'] ."'>". $user_class->formattedname ." </a><br/>" ?> </td>
	<td width='15%'>HP:</td>

	<td width='35%'><?php echo $user_class->formattedhp; ?></td>
	
</tr>
<tr>
	<td width='15%'>Level:</td>
	<td width='35%'><?php echo $user_class->level; ?></td>
	<td width='15%'>Energy:</td>
	<td width='35%'><?php echo $user_class->formattedenergy; ?></td>

</tr>

<tr>
	<td width='15%'>Money:</td>
	<td width='35%'>$<?php echo $user_class->money; /*money_format('%(#10n', $user_class->money);*/ ?></td>
	<td width='15%'>Awake:</td>
	<td width='35%'><?php echo $user_class->formattedawake; ?></td>
</tr>

<tr>
	<td width='15%'>Bank:</td>
	<td width='35%'>$<?php echo $user_class->bank; /*money_format('%(#10n', $user_class->bank);*/ ?></td>
	<td width='15%'>Nerve:</td>
	<td width='35%'><?php echo $user_class->formattednerve; ?></td>
</tr>

<tr>
	<td width='15%'>EXP:</td>

	<td width='35%'><?php echo $user_class->formattedexp; ?></td>
	<td width='15%'>Work EXP:</td>
	<td width='35%'><?php echo $user_class->workexp; ?></td>
</tr>
<tr>
	<td width='15%'>Prostitutes:</td>
	<td width='35%'><?php echo $user_class->hookers; ?></td>
	<td width='15%'>Marijuana:</td>
	<td width='35%'><?php echo $user_class->marijuana; ?></td>
</tr>
</table>
</td>
</tr>

</table>
<div class="row" style="height:10px;"></div>
<table class="content">

<div class="row">
<tr>
<td class="contenthead">Attributes</td>
</tr>
<table class="content">
<tr>

<table width='100%'>
<tr>
	<td width='15%'>Strength:</td>
	<td width='35%'><?php echo $user_class->strength; ?></td>

	<td width='15%'>Defense:</td>
	<td width='35%'><?php echo $user_class->defense; ?></td>
</tr>

<tr>
	<td width='15%'>Speed:</td>
	<td width='35%'><?php echo $user_class->speed; ?></td>
	<td width='15%'>Total:</td>

	<td width='35%'><?php echo $user_class->totalattrib; ?></td>
</tr>
</table>
</td>
</tr>
</table>
<div class="row" style="height:10px;"></div>
<table class="content">
  </div>
<div class="row">
<tr><td class="contenthead">Battle Stats</td></tr>
<table class="content">

<table width='100%'>
<tr>
	<td width='15%'>Won:</td>
	<td width='35%'><?php echo $user_class->battlewon ?></td>
	<td width='15%'>Lost:</td>
	<td width='35%'><?php echo $user_class->battlelost; ?></td>

</tr>

<tr>
	<td width='15%'>Total:</td>
	<td width='35%'><?php echo $user_class->battletotal; ?></td>
	<td width='15%'>Money Gain:</td>
	<td width='35%'>$<?php echo $user_class->battlemoney; ?></td>
</tr>
</table>
</td>
</tr>
</table>
<div class="row" style="height:10px;"></div>
<table class="content">
  </div>
<div class="row">
<tr>
<td class="contenthead">Crime Stats</td>
</tr>
<table class="content">
<tr>

<table width='100%'>

<tr>
	<td width='15%'>Succeeded:</td>
	<td width='35%'><?php echo $user_class->crimesucceeded; ?></td>
	<td width='15%'>Failed:</td>
	<td width='35%'><?php echo $user_class->crimefailed; ?></td>
</tr>

<tr>
	<td width='15%'>Total:</td>

	<td width='35%'><?php echo $user_class->crimetotal; ?></td>
	<td width='15%'>Money Gain:</td>
	<td width='35%'>$<?php echo $user_class->crimemoney; ?></td>
</tr>
</table></td>
</tr>
  </div>

