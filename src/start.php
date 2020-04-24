<?php

// todo - refactor where this is called, this will do for now until we have a better defined structure

// parses .env and populates environment variables ($_ENV / getenv())
Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR)->load();
