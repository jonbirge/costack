# Company in a (Docker) Box

## About

This repo is a docker-compose file and associated environment settings files
that will allow you to instantly stand up a pretty decent company server,
including public facing web site, file sharing and a few back-end
services for internal users, notably Guacamole for access to internal desktops
and servers. A company of any significant size would probably want to split
these things across multiple servers, but the goal here is to create something
affordable to run on a single cloud server that will help a small seed-stage
business provide a few resources.

Traefik is used to distribute traffic to the various backend services, as well
as offer protection by country. The default configuration discards traffic from
the top ten countries for cyber attacks for public services, and only allows
internal service connections from the US.

**This is still under development, so not everything is implemented yet.** See
the next section for work that still needs to be done.

## Future work

- Break traefik routing into public- and private-facing services by domain name
- Switch to WordPress server for public-facing webpage
- LDAP server that is also used for auth
- Central config script
- Script to create the initial dB for Guacamole.
- Mail server with SMTP and web-based back-end
- Implement as Digital Ocean custom droplet with automatic configuration
- Expand to use stacks/kube to support scaling to multiple servers, if desired

## Installation

### Configuration

Rename the file called `config.env` to `.env` and edit the content to match
your system:

```
SQL_USER=[sql user name]
SQL_PASS=[any password you choose]
HOSTNAME=[your external hostname]
EMAIL=[admin e-mail address]
```

You will also probably want to configure the dynamic Traefik configuration file
to match your desired level of security paranoia. The default settings are
pretty restrictive, discarding traffic from several countries based on IP.

Lastly, and I know this sucks, you'll have to initialize the SQL database for
Guacamole, if you're planning on using that. See the instructions from their
hub.docker.com page for that. I'm working on a better solution for that,
but in the meanwhile you have to do it manually.

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
