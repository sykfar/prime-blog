<form class="header-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
  </svg>
  <label class="sr-only" for="prime-search"><?php esc_html_e( 'Search', 'prime-blog' ); ?></label>
  <input
    id="prime-search"
    type="search"
    name="s"
    placeholder="<?php esc_attr_e( 'Search…', 'prime-blog' ); ?>"
    value="<?php echo esc_attr( get_search_query() ); ?>"
    autocomplete="off"
  >
</form>
