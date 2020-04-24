<?php

declare(strict_types=1);

class Gang
{
    public int $id;
    public int $members;
    public string $name;
    public string $formattedname;
    public ?string $description;
    public string $leader;
    public string $tag;
    public int $exp;
    public int $level;
    public int $vault;

    function __construct($id)
    {
        $result = DB::run("SELECT * FROM `gangs` WHERE `id`='$id'");
        $worked = $result->fetch();
        $gangcheck = DB::run("SELECT * FROM `grpgusers` WHERE `gang`= ?",[$id]);

        $this->id = $worked['id'];
        $this->members = $gangcheck->rowCount();
        $this->name = $worked['name'];
        $this->formattedname = "<a href='viewgang.php?id=".$worked['id']."'>".$worked['name']."</a>";
        $this->description = $worked['description'];
        $this->leader = $worked['leader'];
        $this->tag = $worked['tag'];
        $this->exp = $worked['exp'];
        $this->level = Get_The_Level($this->exp);
        $this->vault = $worked['vault'];
    }
}
