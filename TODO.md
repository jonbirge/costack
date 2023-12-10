# TODO

- Integrate directory listing code
- WebDAV file sharing
- Split Traefik into public and private domain names
- Wordpress public-facing site
  - Add FastCGI version of WordPress?
  - Configure Traefik to send /wp-admin/... through middleware
- Auth for all private services based on LDAP?
- Mail server and web interface
- Script to initialize Guacamole db using Guacamole container
- Put Traefik dashboard on HTTPS/HTTP port and protect with `auth` middleware
- Digital Ocean integration?
- Use Docker secrets for passwords?
- Docker container to produce a live traceroute using AJAX
  - Build from stock nginx with PHP support added
  - Add proper traceroute tool to container
  - HTML file using JavaScript at root
- Intranet page with links to services?

