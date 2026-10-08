#!/bin/sh
set -e
SRC=/usr/src/wordpress/wp-content
DST=/var/www/html/wp-content
if [ -e /var/www/html/wp-includes/version.php ]; then
	for p in plugins/amfie-blocks themes/twentytwentyfive; do
		# Skip bind mounts (local dev override)
		if ! mountpoint -q "$DST/$p"; then
			rm -rf "$DST/$p"
			cp -a "$SRC/$p" "$DST/$p"
		fi
	done
fi
exec docker-entrypoint.sh "$@"
