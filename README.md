Запуск приложения: 

Приложение доступно их директории www/test.dev/web
==============================
Конфигурационный файл Nginx 

Наименование хоста test.dev

upstream php-fpm
{
    # PHP5-FPM сервер
    server unix:/var/run/php5-fpm.sock;
}


server {
	
	listen *:80; ## listen for ipv4

	charset utf-8;

	set $host_path "/var/www/sites/test/web/";
	server_name  test.dev *.test.dev;
	

    	root   $host_path;
    	set $yii_bootstrap "index.php";
	
	# access_log /var/log/nginx/test.dev-access.log;
	error_log /var/log/nginx/test.dev-error.log;
	
	location / {
		index  index.html $yii_bootstrap;
        	try_files $uri $uri/ /$yii_bootstrap?$args;
        }

        location ~ \.(images|js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
        	root $host_path;
		try_files $uri =404;
    	}

	location ~ \.php {
		fastcgi_split_path_info  ^(.+\.php)(.*)$;
		root $host_path;
		# phpdaemon application
		# fastcgi_param APPNAME YiiOmertaApplication; 
		# позволяем yii перехватывать запросы к несуществующим PHP-файлам
		set $fsn $yii_bootstrap;
		if (-f $document_root$fastcgi_script_name){
		    set $fsn $fastcgi_script_name;
		}
		proxy_buffer_size 32k;
		proxy_connect_timeout 300s; 
		proxy_send_timeout 300s; 
		proxy_read_timeout 300s;
		# upstream php
		fastcgi_pass  php-fpm; 
		
		include fastcgi_params;
		fastcgi_param  SCRIPT_FILENAME  $document_root$fsn;

		# PATH_INFO и PATH_TRANSLATED могут быть опущены, но стандарт RFC 3875 определяет для CGI
		fastcgi_param  PATH_INFO        $fastcgi_path_info;
		fastcgi_param  PATH_TRANSLATED  $document_root$fsn;
    	}

     	# не позволять nginx отдавать файлы, начинающиеся с точки (.htaccess, .svn, .git и прочие)
    	location ~ /\. {
		deny all;
		access_log off;
		log_not_found off;
   	}
	
}

===============================

Если не накатывали дамп базы из файла, то выполните миграции из корня проекта
./yii migrate
Будут созданы пустые таблицы. Наполните данными или заполните их тестовыми из SQL дампа. Для этого миграции запускать не нужно.

Выполнено на Yii 2, так как работать будем в проекте именно с ним. 
Использованы сторонние расширения (в composer.json в секции require)

Окружение: linux
PHP: PHP 5.5.9-1ubuntu4.19
Сервер: Nginx + PHP-Fpm (обработчик php) 
Конфиг для nginx в корне проекта

Yii: basic template

########################################################################################

# Для того чтобы работать с отчетами нужно авторизоваться
Login: demo
Password: demo

# База данных MySQL  (Server version: 5.6.15 MySQL Community Server (GPL))
!!! Внешние ключи не использую так как на больших данных они дают приличные тормоза. Контроль целостности осуществляется на уровне
приложения (в моделях)

В корне приложения файл дампа SQL с тестовыми данными

------------------ TIME Job -----------------------------------------------
Время исполнения данного задания с 19 час 40 мин до 22 час 30 мин
---------------------------------------------------------------------------

Тестовое задание 
===============================================
Тестовое задание ООО "Современные страховые технологии"

Вы разрабатываете ПО на PHP для секретной военной лаборатории и в данный момент вы реализовываете ту часть, которая отвечает за хранение секретных расчетов.
Расчет представляет собой произвольные данные в текстовом виде и может включать секретные коды.  
Секретные коды в расчете — это обычные целые числа (положительные и отрицательные), заключенные в фигурные скобки.  
Таким образом, если в расчете встречаются фигурные скобки и между ними находятся только цифры или цифры со знаком "+" или "-" в начале, то это секретный код. 
Вот пример такого расчета: 

-------------- начало ---------------- 
demis 
4 
lala-}blab{la ! =)) 
:( 
{457}7775         {-1.000001 } 
32 
{+98} 
{2}           {+3.14}  {12637} 9812 {89123789} 
1 
O   O1         01 
1O 
1}OO 
{zer}o! 
{df1000 ggg... 
{5-} 
105} 
{-2010} 
wass{auupp!! 
--------------- конец ---------------- 

В этом расчете присутствуют следующие секретные коды по порядку: 457, 98, 2, 12637, 89123789, -2010.
"3.14", "-1.000001", "5-" секретными кодами не являются, так как в них присутствуют лишние символы.

У каждого расчета может быть название, например, "расчет от 10 сентября".

Люди, которые будут пользоваться вашим приложением, хотят получить следующий функционал:

— Добавление и сохранение расчета в БД. При добавлении расчета пользователь указывает его название и в большое текстовое поле вставляет сам расчет. Приложение должно сохранить введенные пользователем данные в БД, разобрать расчет на секретные коды, записать полученные секретные коды в БД, связав их с добавленным расчетом.
— Просмотр списка сохраненных ранее расчетов. Пользователь должен видеть название каждого расчета, расчетные данные и список секретных кодов этого расчета.
— Выбор расчетных данных по секретным кодам. Приложение должно позволять пользователю выбирать расчеты с определенными секретными кодами. Например, пользователь может захотеть увидеть расчеты:
  — в которых есть секретные коды больше 2000
  — в которых есть секретный код 2
  — в которых присутствуют секретные коды меньше 50000
 
Примечания.
Можно пользоваться любым сторонним кодом.
Результат должен быть в виде архива, включающим в себя код на PHP и SQL таблиц для СУБД MySQL и без дополнительных настроек запускаться при распаковке в www-директорию веб-сервера.
========================================================================================


