import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import colors from "vuetify/lib/util/colors";

Vue.use(Vuetify);

const opts = {};

export default new Vuetify({
    opts,
    theme: {
        themes: {
            light: {
                primary: colors.blue, // #E53935
                secondary: colors.red.lighten4, // #FFCDD2
                accent: colors.indigo.base // #3F51B5
            }
        }
    }
});
