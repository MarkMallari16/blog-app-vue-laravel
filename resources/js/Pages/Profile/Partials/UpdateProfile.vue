<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  avatar: null,
});

const submit = () => {
  form.post(route("profile.avatar.update"));
};

</script>

<template>
  <InputLabel for="avatar" value="Avatar"/>
  <form @submit.prevent="submit">
    <div>
      <div class="mt-2 flex flex-col">
        <input ref="avatar" type="file" @input="form.avatar = $refs.avatar.files[0]" />
        <InputError :message="form.errors.avatar" class="mt-2" />
      </div>

      <div class="flex items-center gap-4 mt-4">
        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
          
        >
          <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
            Profile successfully updated.
          </p>
        </Transition>
      </div>
    </div>
  </form>
</template>
