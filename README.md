# Company in a Box

## About

This repo is just a docker-compose file and associated environment settings file that allows you to instantly stand up a pretty decent company web server, including public facing WordPress site and a few back-end services for internal users, notable Guacamole. A company of any size would probably want to split these things across multiple servers, but for a small company this gets you up and running quickly and with minimal cost by sharing a database across all the services.

## Configuration

Rename the file called `config.env` to `.env` and edit the content to match your system:

```
SQL_PASS=[anypassword]
HOSTNAME=[hostname]
EMAIL=[email-for-lets-encrypt]
```

## Certificates

If you want root-signed certs from Let's Encrypt, then do the following in `.env`:
- Make sure `HOSTNAME` is your full public server domain name. 
- Set your e-mail to something you're willing to give to Let's Encrypt.

## Running

Once you've configured the environment variables in the `.env` file, you should just be able to run

```
$ docker-compose up -d
```

## Major future work

Would appreciate help or pull requests on any of the following

- Ideally, there would be a script that would create the initial dBs for everything where the containers themselves will not.
- Add mail server
- Expand to use stacks/kube to support scaling and services across multiple servers?
