<template>
    <div v-if="loaded">
        <div class="flex mb-6 items-center justify-between">
            <heading>
                {{ __('Server Monitor') }}
            </heading>
        </div>

        <card class="mb-6">
            <table cellpadding="0" cellspacing="0" class="checks-table table w-full">
                <thead>
                    <tr>
                        <th class="text-left rounded-tl">
                            {{ __('Host') }}
                        </th>
                        <th class="text-left">
                            {{ __('Check') }}
                        </th>
                        <th class="text-left">
                            {{ __('Status') }}
                        </th>
                        <th class="text-left">
                            {{ __('Detail') }}
                        </th>
                        <th class="text-left rounded-tr">
                            {{ __('Last Run') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="check in checks" :key="check.id">
                        <td>{{ check.host.name }}</td>
                        <td>{{ check.type }}</td>
                        <td>
                            <svg
                                :is="checkStatusIcon(check.status)"
                                height="24px"
                            />
                        </td>
                        <td>{{ check.last_run_message }}</td>
                        <td>{{ check.last_ran_at }}</td>
                    </tr>
                </tbody>
            </table>
        </card>
    </div>
</template>

<script>
import IconSuccess from './icons/IconSuccess';
import IconFailed from './icons/IconFailed';
import IconWarning from './icons/IconWarning';
import IconUnknown from './icons/IconUnknown';
import api from '../api';

export default {
    data: () => ({
        loaded: false,
        checks: [],
    }),

    components: {
        IconSuccess,
        IconFailed,
        IconWarning,
        IconUnknown
    },

    async created() {
        await this.updateChecks();

        this.loaded = true;
    },

    methods: {
        checkStatusIcon(status) {
            switch(status) {
                case 'success':
                    return 'icon-success';
                case 'warning':
                    return 'icon-warning';
                case 'failed':
                    return 'icon-failed';
                case 'not yet checked':
                default:
                    return 'icon-unknown';
            }

            return 'icon-unknown';
        },

        updateChecks() {
            return api.getCheckStatusList().then(data => {
                this.checks = data.checks;
            });
        },
    }
};
</script>