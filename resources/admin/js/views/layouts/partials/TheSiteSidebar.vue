<template>
  <div class="sidebar-left">
    <div class="sidebar-body scroll-pane">
      <div class="side-nav">
        <v-collapse accordion>
          <v-collapse-item active-url="/backend">
            <a slot="item-title" href="#">
              <i class="fa fa-map-signs" aria-hidden="true"></i>
              Страницы
            </a>

            <router-link :to="{name: 'pages.index'}">
              <i class="fa fa-th-list fa-fw" aria-hidden="true"></i> Cписок
            </router-link>

            <router-link :to="{name: 'page.create'}">
              <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Добавить
            </router-link>
          </v-collapse-item>
        </v-collapse>
      </div>
    </div>
  </div>
</template>