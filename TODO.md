# TODO

- Configure Traefik to send /wp-admin/... through middleware
- Add WebDAV and public file interface container
- Write script to initialize Guacamole db using guacamole container
- Put Traefik dashboard on HTTPS port and protect with password
- Use FastCGI version of WordPress and any other images that support it
- Use the Traefik plug-in to dynamically drop unused container services
- Split into two docker-compose files, one for Traefik and one for the rest?
- Use Docker secrets for sensitive passwords?
