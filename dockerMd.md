# Apuntes sobre docker

## docker pull "x"

     crea un contenedor en base a una imagen "x"

## docker Stop/start "ID/name"

    detiene o inicia la ejecucion de un contenedor asignado con su id o name

## docker run

    crea y ejecuta un contenedor en base a una imagen "x"

## docker run -p 8080:80 -d nginx

    crea y ejecuta un contenedor de nginx y ademas con "-p" asigna un puerto local al puerto definido del contenedor (en este caso el 80), y luego se asigna que se ejecute en segundo plano.

## docker ps -a

    se utiliza para visualizar los contenedores en ejecución, si se agrega "-a" se a;istan todos los contenedores independientemente de su estado
