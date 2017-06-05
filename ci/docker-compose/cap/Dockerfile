FROM ruby:2.3.1

MAINTAINER Piotr Theis <piotr_theis@o2.pl>

RUN gem install capistrano && \
    gem install cabin \
                childprocess \
                gem-wrappers \
                ffi \
                executable-hooks \
                arr-pm \
                backports

RUN gem install capistrano-laravel


ADD cap.sh /cap.sh
RUN chmod +x /cap.sh

# docker build -t cap .
# docker run --rm -v ~/.ssh:/ssh-keys -v $(pwd):/usr/src/app -w /usr/src/app cap /cap.sh production deploy