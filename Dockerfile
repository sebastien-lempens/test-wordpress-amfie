# syntax=docker/dockerfile:1

ARG WP_TAG=php8.4-apache
FROM wordpress:${WP_TAG}

ARG WPGRAPHQL_VERSION=2.20.0
# Pinned develop tip: adds rich-text attribute support (WP 6.5+) missing from tag v0.4.1
ARG GUTENBERG_REF=4dd439c8cf3939c0e605119d27beac3f77058145

RUN apt-get update \
	&& apt-get install -y --no-install-recommends unzip \
	&& rm -rf /var/lib/apt/lists/*

# Plugins must live under /usr/src/wordpress so they survive
# the entrypoint's copy into the /var/www/html volume on first boot.
ARG PLUGINS_DIR=/usr/src/wordpress/wp-content/plugins

# WPGraphQL (distributed via WordPress.org)
ADD https://downloads.wordpress.org/plugin/wp-graphql.${WPGRAPHQL_VERSION}.zip /tmp/wp-graphql.zip
RUN unzip -q /tmp/wp-graphql.zip -d "${PLUGINS_DIR}" \
	&& rm -f /tmp/wp-graphql.zip

# WPGraphQL for Gutenberg (GitHub, pinned commit; build/ + vendor/ are committed upstream,
# so the source archive is directly usable as a plugin)
ADD https://github.com/pristas-peter/wp-graphql-gutenberg/archive/${GUTENBERG_REF}.tar.gz /tmp/gutenberg.tar.gz
RUN tar -xzf /tmp/gutenberg.tar.gz -C "${PLUGINS_DIR}" \
	&& mv "${PLUGINS_DIR}/wp-graphql-gutenberg-${GUTENBERG_REF}" "${PLUGINS_DIR}/wp-graphql-gutenberg" \
	&& rm -f /tmp/gutenberg.tar.gz

# Compatibility fix: wp-graphql-gutenberg 0.4.1 predates webonyx/graphql-php v15
# (bundled with WPGraphQL 2.x), which requires a typed bool return on ClientAware::isClientSafe().
RUN find "${PLUGINS_DIR}/wp-graphql-gutenberg/src" -name '*.php' \
	-exec sed -i 's/function isClientSafe()/function isClientSafe(): bool/' {} +

# Compatibility fix: WP >= 6.6 parse_blocks() returns attrs=null for blocks
# without an attribute comment; the plugin expects an array (array_merge).
RUN find "${PLUGINS_DIR}/wp-graphql-gutenberg/src" -name 'Block.php' \
	-exec sed -i "s/\$attributes = \$data\['attrs'\];/\$attributes = \$data['attrs'] ?? [];/" {} +

# Custom plugin + theme baked in (no bind mounts: they break on Coolify).
COPY --chown=www-data:www-data wp-files/plugins/amfie-blocks ${PLUGINS_DIR}/amfie-blocks
COPY --chown=www-data:www-data wp-files/twentytwentyfive /usr/src/wordpress/wp-content/themes/twentytwentyfive

# The base entrypoint seeds the wp_data volume only once; this wrapper
# refreshes the custom plugin/theme from the image on every start.
COPY docker-entrypoint-amfie.sh /usr/local/bin/docker-entrypoint-amfie.sh
RUN sed -i 's/\r$//' /usr/local/bin/docker-entrypoint-amfie.sh \
	&& chmod +x /usr/local/bin/docker-entrypoint-amfie.sh
ENTRYPOINT ["docker-entrypoint-amfie.sh"]
CMD ["apache2-foreground"]
