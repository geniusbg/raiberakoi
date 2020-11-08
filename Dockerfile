FROM ubuntu:latest
echo "nameserver 8.8.8.8" | sudo tee /etc/resolv.conf > /dev/null
RUN sed -i 's/archive.ubuntu.com/tw.archive.ubuntu.com/g' \
    /etc/apt/sources.list
RUN apt-get update 
RUN apt-get -y install wget net-tools
RUN wget https://downloads.sourceforge.net/project/xampp/XAMPP%20Linux/5.5.35/xampp-linux-x64-5.5.35-0-installer.run?r=https%3A%2F%2Fsourceforge.net%2Fprojects%2Fxampp%2Ffiles%2FXAMPP%2520Linux%2F5.5.35%2Fxampp-linux-x64-5.5.35-0-installer.run%2Fdownload&ts=1604832330
RUN chmod +x xampp-linux-x64-5.5.35-0-installer.run
RUN ./xampp-linux-x64-5.5.35-0-installer.run
RUN rm xampp-linux-x64-5.5.35-0-installer.run
RUN mv /opt/lampp/etc/extra/httpd-xampp.conf /opt/lampp/etc/extra/httpd-xampp.conf.bak
RUN echo "export PATH=\$PATH:/opt/lampp/bin/" >> /root/.bashrc
RUN echo "export TERM=dumb" >> /root/.bashrc
ADD httpd-xampp.conf /opt/lampp/etc/extra/httpd-xampp.conf
VOLUME  ["/opt/lampp/htdocs/"]
EXPOSE 80 443 3306
CMD /opt/lampp/lampp start && tail -F /opt/lampp/logs/error_log
COPY ./raiberakoi /opt/lampp/htdocs/
