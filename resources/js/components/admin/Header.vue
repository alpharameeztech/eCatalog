<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            :clipped="$vuetify.breakpoint.lgAndUp"
            app
        >
            <v-list dense>
                <template v-for="item in items">
                    <v-row
                        v-if="item.heading"
                        :key="item.heading"
                        align="center"
                    >
                        <v-col cols="6">
                            <v-subheader v-if="item.heading">
                                {{ item.heading }}
                            </v-subheader>
                        </v-col>
                        <v-col
                            cols="6"
                            class="text-center"
                        >
                            <a
                                href="#!"
                                class="body-2 black--text"
                            >EDIT</a>
                        </v-col>
                    </v-row>
                    <v-list-group
                        v-else-if="item.children"
                        :key="item.text"
                        v-model="item.model"
                        :prepend-icon="item.model ? item.icon : item['icon-alt']"
                        append-icon=""
                    >
                        <template v-slot:activator>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        {{ item.text }}
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </template>
                        <v-list-item
                            v-for="(child, i) in item.children"
                            :key="i"
                            link
                        >
                            <v-list-item-action v-if="child.icon">
                                <v-icon>{{ child.icon }}</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ child.text }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>
                    <v-list-item
                        v-else
                        :key="item.text"
                        link
                        :to="item.link"
                        v-show="hasUserAccess(item)"
                    >
                        <v-list-item-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content >
                            <v-list-item-title >
                                {{ item.text }}
                                <!--                  <router-link :to="'/admin/channels'">channels</router-link>-->
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            :clipped-left="$vuetify.breakpoint.lgAndUp"
            app
            color="blue darken-3"
            dark
        >
            <v-toolbar-title
                style="width: 300px"
                class="ml-0 pl-4"
            >
                <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
                <a href="/home"><span class="hidden-sm-and-down"  >DealzBook Admin</span></a>
            </v-toolbar-title>

            <v-spacer />

            <template>

                <v-btn
                    color="#fff"
                    dark
                    v-on="on"
                    to="/"
                    target="_blank"
                    outlined
                    class="backToForum"
                >
                    Back to Website
                    <v-icon>forward
                    </v-icon>
                </v-btn>

                <div class="text-center">
                    <v-menu offset-y>
                        <template v-slot:activator="{ on }">
                            <v-btn
                                color="primary"
                                dark
                                v-on="on"
                            >
                                {{ user.name}}
                                <v-icon>arrow_drop_down</v-icon>
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item

                                to="/home/settings/"
                            >
                                <v-list-item-title>Settings</v-list-item-title>
                                <v-icon>settings_applications</v-icon>
                            </v-list-item>
                            <v-list-item

                                @click="logout"
                            >
                                <v-list-item-title> Logout</v-list-item-title>
                                <v-icon>power_settings_new</v-icon>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </div>

            </template>

        </v-app-bar>
        <v-content>

            <flash-component></flash-component>

            <router-view></router-view>

            <loader-component></loader-component>

            <v-container
                class="fill-height"
                fluid
            >

            </v-container>
        </v-content>

    </v-app>
</template>

<script>
    export default {
        props: ['user'],
        data: (vm) => ({
            dialog: false,
            drawer: null,
            items: [
                { icon: 'dashboard', text: 'Dashboard', link: '/home', hasAccess: ['admin', 'publisher'] },
                { icon: 'list_alt', text: 'Countries', link: '/home/countries', hasAccess: ['admin', 'publisher'] },
                { icon: 'location_city', text: 'Cities', link: '/home/cities', hasAccess: ['admin', 'publisher'] },
                { icon: 'store', text: 'Stores', link: '/home/stores', hasAccess: ['admin', 'publisher'] },
                { icon: 'local_mall', text: 'Malls', link: '/home/malls', hasAccess: ['admin', 'publisher'] },
                { icon: 'domain', text: 'Store Branches', link: '/home/branches', hasAccess: ['admin', 'publisher'] },
                { icon: 'label', text: 'Tags', link: '/home/tags', hasAccess: ['admin', 'publisher'] },
                { icon: 'card_giftcard', text: 'Catalogs', link: '/home/catalogs', hasAccess: ['admin', 'publisher'] },
                { icon: 'card_giftcard', text: 'Catalog Images', link: '/home/catalog/images', hasAccess: ['admin', 'publisher'] },
                { icon: 'picture_as_pdf', text: 'Catalog Pdfs', link: '/home/catalog/pdfs', hasAccess: ['admin', 'publisher'] },
                { icon: 'question_answer', text: 'FAQs', link: '/home/faqs', hasAccess: ['admin', 'publisher'] },
                { icon: 'flag', text: 'Terms & Conditions', link: '/home/terms', hasAccess: ['admin', 'publisher'] },
                { icon: 'library_books', text: 'Blogs', link: '/home/blogs', hasAccess: ['admin', 'publisher'] },
                { icon: 'info', text: 'About Us', link: '/home/about', hasAccess: ['admin', 'publisher'] },
                { icon: 'home', text: 'Home Page', link: '/home/homepage', hasAccess: ['admin', 'publisher'] },
                { icon: 'share', text: 'Social Media', link: '/home/socials', hasAccess: ['admin', 'publisher'] },
                { icon: 'perm_media', text: 'Home Banner', link: '/home/banners', hasAccess: ['admin', 'publisher'] },
                { icon: 'theaters', text: 'Advertisements', link: '/home/advertisements', hasAccess: ['admin', 'publisher'] },
                { icon: 'contacts', text: 'Contacts', link: '/home/contacts', hasAccess: ['admin', 'publisher'] },

            ]

        }),
        mounted(){


        },

        methods: {

            hasUserAccess (item) {

                var self = this;

                this.types  = item.hasAccess

                this.userType = self.user.type

                if(this.types.includes(this.userType))
                {
                    return true
                }
                else
                {
                    return false
                }


            },

            logout(){

                axios.post('/logout', {

                })
                    .then(function (response) {

                        window.location.href = "/"

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        }
    }
</script>
