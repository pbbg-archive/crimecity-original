<?php

declare(strict_types=1);

class User
{
    public int $id;
    public string $username;
    public string $formattedname = '';

    public int $eqweapon = 0;
    public string $weaponname = "fists";
    public string $weaponimg;

    public int $eqarmor = 0;
    public string $armorname;
    public string $armorimg;

    public int $weaponoffense = 0;
    public int $armordefense = 0;

    public int $moddedstrength;
    public int $moddeddefense;

    public string $ip;
    public int $style;

    public int $speedbonus;

    public int $marijuana;
    public int $potseeds;
    public int $cocaine;
    public int $nodoze;
    public int $genericsteroids;
    public int $hookers;

    public int $level;

    public int $exp;
    public int $maxexp;
    public float $exppercent;
    public string $formattedexp;

    public int $money;
    public int $bank;
    public int $whichbank;

    public int $hp;
    public int $maxhp;
    public float $hppercent;
    public string $formattedhp;

    public int $energy;
    public int $maxenergy;
    public float $energypercent;
    public string $formattedenergy;

    public int $nerve;
    public int $maxnerve;
    public float $nervepercent;
    public string $formattednerve;

    public int $workexp;

    public int $strength;
    public int $defense;
    public int $speed;

    public int $totalattrib;

    public int $battlewon;
    public int $battlelost;
    public int $battletotal;
    public int $battlemoney;
    public int $crimesucceeded;
    public int $crimefailed;
    public int $crimetotal;
    public int $crimemoney;

    public int $lastactive;
    public string $age;
    public string $formattedlastactive;

    public int $points;
    public int $credits;
    public int $rmdays;
    public int $signuptime;

    public int $house;
    public string $housename;
    public int $houseawake;

    public int $awake;
    public int $maxawake;
    public float $awakepercent;
    public string $formattedawake;

    public string $email;
    public int $admin;
    public ?string $quote;
    public ?string $avatar;

    public int $gang;
    public ?string $gangname;
    public ?string $gangleader;
    public string $gangtag;
    public string $gangdescription;
    public string $formattedgang = '';

    public int $city;
    public string $cityname;

    public int $jail;
    public ?int $job;
    public int $hospital;
    public int $searchdowntown;

    public string $type;

    function __construct($id)
    {
        $worked = DB::run("SELECT * FROM `grpgusers` WHERE `id`=?",[$id])->fetch();
        $worked2 = DB::run("SELECT * FROM `gangs` WHERE `id`= ?",[$worked['gang']])->fetch();
        $worked3 = DB::run("SELECT * FROM `cities` WHERE `id`= ?",[$worked['city']])->fetch();
        $worked4 = DB::run("SELECT * FROM `houses` WHERE `id`= ? ",[$worked['house']])->fetch();
        $checkcocaine = DB::run("SELECT * FROM `effects` WHERE `userid`='".$id."' AND `effect`='Cocaine'");

        $cocaine = $checkcocaine->rowCount();

        if ($worked['eqweapon'] != 0) {
            $worked6 = DB::run("SELECT * FROM `items` WHERE `id`= ?",[$worked['eqweapon']])->fetch();
            $this->eqweapon = $worked6['id'];
            $this->weaponoffense = $worked6['offense'];
            $this->weaponname = $worked6['itemname'];
            $this->weaponimg = $worked6['image'];
        }

        if ($worked['eqarmor'] != 0) {
            $result6 = DB::run("SELECT * FROM `items` WHERE `id`='".$worked['eqarmor']."' LIMIT 1");
            $worked6 = $result6->fetch();
            $this->eqarmor = $worked6['id'];
            $this->armordefense = $worked6['defense'];
            $this->armorname = $worked6['itemname'];
            $this->armorimg = $worked6['image'];
        }

        $this->moddedstrength = (int) ($worked['strength'] * ($this->weaponoffense * .01 + 1));
        $this->moddeddefense = (int) ($worked['defense'] * ($this->armordefense * .01 + 1));

        $this->id = $worked['id'];
        $this->ip = $worked['ip'];
        $this->style = ($worked['style'] > 0) ? $worked['style'] : 1;
        $this->speedbonus = ($cocaine > 0) ? (floor($worked['speed'] * .30)) : 0;
        $this->username = $worked['username'];

        $this->marijuana = $worked['marijuana'];
        $this->potseeds = $worked['potseeds'];
        $this->cocaine = $worked['cocaine'];
        $this->nodoze = $worked['nodoze'];
        $this->genericsteroids = $worked['genericsteroids'];
        $this->hookers = $worked['hookers'];

        $this->exp = $worked['exp'];
        $this->level = Get_The_Level($this->exp);
        $this->maxexp = (int) experience($this->level + 1);
        $this->exppercent = ($this->exp == 0) ? 0 : floor(($this->exp / $this->maxexp) * 100);
        $this->formattedexp = $this->exp." / ".$this->maxexp." [".$this->exppercent."%]";

        $this->money = $worked['money'];
        $this->bank = $worked['bank'];
        $this->whichbank = $worked['whichbank'];

        $this->hp = $worked['hp'];
        $this->maxhp = $this->level * 50;
        $this->hppercent = floor(($this->hp / $this->maxhp) * 100);
        $this->formattedhp = $this->hp." / ".$this->maxhp." [".$this->hppercent."%]";

        $this->energy = $worked['energy'];
        $this->maxenergy = 9 + $this->level;
        $this->energypercent = floor(($this->energy / $this->maxenergy) * 100);
        $this->formattedenergy = $this->energy." / ".$this->maxenergy." [".$this->energypercent."%]";

        $this->nerve = $worked['nerve'];
        $this->maxnerve = 4 + $this->level;
        $this->nervepercent = floor(($this->nerve / $this->maxnerve) * 100);
        $this->formattednerve = $this->nerve." / ".$this->maxnerve." [".$this->nervepercent."%]";

        $this->workexp = $worked['workexp'];

        $this->strength = $worked['strength'];
        $this->defense = $worked['defense'];
        $this->speed = $worked['speed'] + $this->speedbonus;

        $this->totalattrib = $this->speed + $this->strength + $this->defense;

        $this->battlewon = $worked['battlewon'];
        $this->battlelost = $worked['battlelost'];
        $this->battletotal = $this->battlewon + $this->battlelost;
        $this->battlemoney = $worked['battlemoney'];
        $this->crimesucceeded = $worked['crimesucceeded'];
        $this->crimefailed = $worked['crimefailed'];
        $this->crimetotal = $this->crimesucceeded + $this->crimefailed;
        $this->crimemoney = $worked['crimemoney'];

        $this->lastactive = $worked['lastactive'];
        $this->age = howlongago($worked['signuptime']);

        $this->formattedlastactive = howlongago($this->lastactive) . " ago";

        $this->points = $worked['points'];
        $this->credits = $worked['credits'];
        $this->rmdays = $worked['rmdays'];
        $this->signuptime = $worked['signuptime'];

        $this->house = $worked['house'];
        $this->housename = $worked4 ? $worked4['name'] : 'Homeless';
        $this->houseawake = $worked4 ? $worked4['awake'] : 100;

        $this->awake = $worked['awake'];
        $this->maxawake = $this->houseawake;
        $this->awakepercent = floor(($this->awake / $this->maxawake) * 100);
        $this->formattedawake = $this->awake." / ".$this->maxawake." [".$this->awakepercent."%]";

        $this->email = $worked['email'];
        $this->admin = $worked['admin'];
        $this->quote = $worked['quote'];
        $this->avatar = $worked['avatar'];
        $this->gang = $worked['gang'];

        if ($worked2) {
            $this->gangname = $worked2['name'];
            $this->gangleader = $worked2['leader'];
            $this->gangtag = $worked2['tag'];
            $this->gangdescription = $worked2['description'];
            $this->formattedgang = "<a href='viewgang.php?id=".$this->gang."'>".$this->gangname."</a>";
        }

        $this->city = $worked['city'];
        $this->cityname = $worked3['name'];
        $this->jail = $worked['jail'];
        $this->job = $worked['job'];
        $this->hospital = $worked['hospital'];

        $this->searchdowntown = $worked['searchdowntown'];

        if ($this->gang != 0) {
            $this->formattedname .= "<a href='viewgang.php?id=".$this->gang."'";
            $this->formattedname .= $this->gangleader == $this->username ? " title='Gang Leader'>[<b>{$this->gangtag}</b>]</a>" : ">[{$this->gangtag}]</a>";
        }

        $this->type = "Regular Mobster";
        $whichfont = null;

        if ($this->rmdays != 0) {
            $this->type = "Respected Mobster";
            $whichfont = "blue";
        }

        if ($this->admin == 1) {

            $this->type = "Admin";
            $whichfont = "red";

        }

        if ($this->admin == 2) {
            $this->type = "Staff";
        }

        if ($this->admin == 3) {
            $this->type = "Pre ent";
            $whichfont = "purple";
        }

        if ($this->admin == 4) {
            $this->type = "Congress";
            $whichfont = "yellow";
        }

        if ($this->rmdays > 0){
            $this->formattedname .= "<b><a title='Respected Mobster [".$this->rmdays." RM Days Left]' href='profiles.php?id=".$this->id."'><font color = '".$whichfont."'>".$this->username."</a></font></b>";
        } elseif ($this->admin != 0) {
            $this->formattedname .= "<b><a href='profiles.php?id=".$this->id."'><font color = '".$whichfont."'>".$this->username."</a></font></b>";
        } else {
            $this->formattedname .= "<a href='profiles.php?id=".$this->id."'><font color = '".$whichfont."'>".$this->username."</a></font>";
        }

        if (time() - $this->lastactive < 300) {
            $this->formattedonline= "<font style='color:green;padding:2px;font-weight:bold;'>[online]</font>";
        } else {
            $this->formattedonline= "<font style='color:red;padding:2px;font-weight:bold;'>[offline]</font>";
        }

    }

}
