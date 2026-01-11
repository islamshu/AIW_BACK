<script setup lang="ts">
    import { ref } from 'vue'
    import { Link, usePage } from '@inertiajs/vue3'
    import { ChevronDown } from 'lucide-vue-next'
    import type { NavItem } from '@/types'
    
    defineProps<{
      items: NavItem[]
    }>()
    
    const openMenus = ref<Record<string, boolean>>({})
    
    function toggle(title: string) {
      openMenus.value[title] = !openMenus.value[title]
    }
    </script>
    
    <template>
      <nav class="space-y-1">
        <div
          v-for="item in items"
          :key="item.title"
          class="space-y-1"
        >
          <!-- ===== Item بدون Submenu ===== -->
          <Link
            v-if="!item.children"
            :href="item.href!"
            class="flex items-center gap-3 px-3 py-2 rounded-md
                   text-sm font-medium
                   text-gray-700 dark:text-gray-200
                   hover:bg-gray-100 dark:hover:bg-gray-800"
          >
            <component
              v-if="item.icon"
              :is="item.icon"
              class="w-4 h-4"
            />
            <span>{{ item.title }}</span>
          </Link>
    
          <!-- ===== Item مع Submenu ===== -->
          <button
            v-else
            @click="toggle(item.title)"
            class="w-full flex items-center justify-between
                   px-3 py-2 rounded-md text-sm font-medium
                   text-gray-700 dark:text-gray-200
                   hover:bg-gray-100 dark:hover:bg-gray-800"
          >
            <div class="flex items-center gap-3">
              <component
                v-if="item.icon"
                :is="item.icon"
                class="w-4 h-4"
              />
              <span>{{ item.title }}</span>
            </div>
    
            <ChevronDown
              class="w-4 h-4 transition-transform"
              :class="{ 'rotate-180': openMenus[item.title] }"
            />
          </button>
    
          <!-- ===== Submenu ===== -->
          <div
            v-if="item.children && openMenus[item.title]"
            class="mr-7 space-y-1 border-r border-gray-200 dark:border-gray-700 pr-3"
          >
            <Link
              v-for="child in item.children"
              :key="child.title"
              :href="child.href!"
              class="block px-3 py-1.5 rounded-md text-sm
                     text-gray-600 dark:text-gray-300
                     hover:bg-gray-100 dark:hover:bg-gray-800"
            >
              {{ child.title }}
            </Link>
          </div>
        </div>
      </nav>
    </template>
    