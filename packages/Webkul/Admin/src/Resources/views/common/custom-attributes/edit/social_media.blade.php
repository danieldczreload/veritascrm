@if (isset($attribute))
    <social_media-component
        :attribute='@json($attribute)'
        :data='@json(old($attribute->code) ?: $value)'
    ></social_media-component>
@endif

@once
    @push('scripts')

        <script type="text/x-template" id="social_media-component-template">
            <div class="social_media-control">
                <div
                    class="form-group input-group"
                    v-for="(social_media, index) in social_media"
                    :class="[errors.has('{!! $formScope ?? '' !!}' + attribute['code'] + '[' + index + '][value]') ? 'has-error' : '']"
                >
                    <input
                        type="text"
                        :name="attribute['code'] + '[' + index + '][value]'"
                        class="control"
                        v-model="social_media['value']"
                        :data-vv-as="attribute['name']"
                    >

                    <div class="input-group-append">
                        <select :name="attribute['code'] + '[' + index + '][label]'" class="control" v-model="social_media['label']">
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="instagram">Linkedin</option>
                            <option value="instagram">Whatsapp</option>
                            <option value="instagram">Otro</option>
                        </select>
                    </div>

                    <i class="icon trash-icon" v-if="social_media.length > 1" @click="removeSocialMedia(social_media)"></i>

                    <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + attribute['code'] + '[' + index + '][value]')">
                        @{{ errors.first('{!! $formScope ?? '' !!}' + attribute['code'] + '[' + index + '][value]') }}
                    </span>
                </div>

                <a class="add-more-link" href @click.prevent="addSocialMedia">+ {{ __('admin::app.common.add_more') }}</a>
            </div>
        </script>

        <script>
            Vue.component('social_media-component', {

                template: '#social_media-component-template',

                props: ['attribute', 'data'],

                inject: ['$validator'],

                data: function () {
                    return {
                        social_media: this.data,
                    }
                },

                watch: {
                    data: function(newVal, oldVal) {
                        if (JSON.stringify(newVal) !== JSON.stringify(oldVal)) {
                            this.social_media = newVal || [{'value': '', 'label': 'facebook'}];
                        }
                    }
                },

                created: function() {
                    /*this.extendValidator();*/

                    if (! this.social_media || ! this.social_media.length) {
                        this.social_media = [{
                            'value': '',
                            'label': 'facebook'
                        }];
                    }
                },

                methods: {
                    addSocialMedia: function() {
                        this.social_media.push({
                            'value': '',
                            'label': 'facebook'
                        })
                    },

                    removeSocialMedia: function(sm) {
                        const index = this.social_media.indexOf(sm);

                        Vue.delete(this.social_media, index);
                    },

                    /*extendValidator: function () {
                        this.$validator.extend('unique_email', {
                            getMessage: (field) => '{!! __('admin::app.common.duplicate-value') !!}',

                            validate: (value) => {
                                let filteredEmails = this.emails.filter((email) => {
                                    return email.value == value;
                                });

                                if (filteredEmails.length > 1) {
                                    return false;
                                }

                                this.removeUniqueErrors();

                                return true;
                            }
                        });
                    },*/

                    isDuplicateExists: function () {
                        let social_media = this.social_media.map((sm) => sm.value);

                        return social_media.some((sm, index) => social_media.indexOf(sm) != index);
                    },

                    removeUniqueErrors: function () {
                        if (! this.isDuplicateExists()) {
                            this.errors
                                .items
                                .filter(error => error.rule === 'unique')
                                .map(error => error.id)
                                .forEach((id) => {
                                    this.errors.removeById(id);
                                });
                        }
                    }
                }
            });
        </script>
    @endpush
@endonce
