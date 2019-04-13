<template>
  <div class="sidebar-left">
    <div class="sidebar-body scroll-pane">
      <div class="side-nav">
        <v-collapse accordion>
          <v-collapse-item active-url="/backend/pages">
            <a slot="item-title" href="#">
              <i class="fa fa-dashboard"/>
              Страницы
              <span class="fa fa-arrow fa-fw"/>
            </a>

            <router-link :to="{name: 'pages.index'}">
              Cписок
            </router-link>

            <router-link :to="{name: 'page.create'}">
              Добавить
            </router-link>
          </v-collapse-item>
        </v-collapse>
      </div>
    </div>
  </div>
</template>