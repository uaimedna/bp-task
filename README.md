# Bored Panda task by Justas Sakalauskas

## Setup instructions:

1. Get dependencies:

```bash
composer install
```

2. Create a database named 'bp-task' running on localhost port 8889 (all this can be configured in config/app.php)

3. Run migrations:

```bash
bin/cake migrations migrate
```

4. Visiting the home page you will be prompter to login. There is a default username created: uaimedna@gmail.com with password: asdasd

## Introduction
I created the task using CakePHP framework and top of my own codebase providing the user interface (to save time)
Main files to review related to this task:  

```bash
src/Shell/YoutubeShell.php

src/Controller/VideosController.php
src/Model/Table/VideosTable.php

src/Template/Videos/index.ctp

config/migraitons
```

The shell can be run from command line using: 

```bash
bin/cake youtube scrapeChanel 
```
Additional parameter can be provided to scrap a specified youtube chanel: 

```bash
bin/cake youtube scrapeChanel myChanelId
```

I think It would be reasonable to run this command every 10minutes.
The current performance on my machine is 30videos/s including the statistic tracking and updating
My first idea at improving the speed would be to add relevant indexes in mysql tables

I used native html5 autocomplete so there is (sadly) no aditional JS involved

Lastly if theres no time for setting up this project heres a snippet of how it looks inside:

![](https://image.ibb.co/e9GX9S/Screen_Shot_2018_05_03_at_1_28_15_AM.png)