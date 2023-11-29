# Company in a Box

## About

This repo is a docker-compose file and associated environment settings files
that will allow you to instantly stand up a pretty decent company web server,
including public facing WordPress site, file sharing and a few back-end
services for internal users, notably Guacamole for access to internal desktops
and servers. A company of any significant size would probably want to split
these things across multiple servers, but for a small company this gets you up
and running quickly and with minimal cost by sharing a database across all the
services.

Traefik is used to distribute traffic to the various backend services, as well
as offer protection by country. The default configuration discards traffic from
the top ten countries for cyber attacks for public services, and only allows
internal service connections from the US.

**This is still under development, so not everything is implemented yet.** See
the next section for work that still needs to be done.

## Future work

Would appreciate help or pull requests on any of the following

- Add wordpress server for public-facing webpage
- Nginx-based WebDAV and web-based file sharing
- Script to create the initial dB for Guacamole. Ideally, this would be
  implemented as a container.
- Mail server with SMTP and web-based back-end
- Expand to use stacks/kube to support scaling to multiple servers, if desired.

## Installation

### Configuration

Rename the file called `config.env` to `.env` and edit the content to match
your system:

```
SQL_USER=[sql user name]
SQL_PASS=[anypassword you choose]
HOSTNAME=[external hostname]
EMAIL=[admin e-mail address]
```

You will also probably want to configure the dynamic Traefik configuration file
to match your desired level of security paranoia. The default settings is
pretty restrictive, dicarding traffic from a lot of countries based on IP.

### Certificates

If you want root-signed certs from Let's Encrypt, then do the following in
`.env`:

- Make sure `HOSTNAME` is your full public server domain name. 
- Set `EMAIL` to something you're willing to give to the good folks at Let's
  Encrypt.

### Running

Once you've configured the environment variables in the `.env` file, you should
just be able to run:

``` $ docker-compose up -d ```
