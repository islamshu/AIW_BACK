<script setup lang="ts">
    import { EditorContent, useEditor } from '@tiptap/vue-3'
    import StarterKit from '@tiptap/starter-kit'
    import Underline from '@tiptap/extension-underline'
    import Link from '@tiptap/extension-link'
    import Placeholder from '@tiptap/extension-placeholder'
    import TextAlign from '@tiptap/extension-text-align'
    import { watch, onBeforeUnmount } from 'vue'
    
    const props = defineProps<{
      modelValue: string | null
      placeholder?: string
    }>()
    
    const emit = defineEmits<{
      (e: 'update:modelValue', value: string): void
    }>()
    
    const editor = useEditor({
      content: props.modelValue ?? '',
      extensions: [
        StarterKit,
        Underline,
        Link.configure({ openOnClick: false }),
        Placeholder.configure({
          placeholder: props.placeholder ?? 'ابدأ بكتابة المحتوى هنا...',
        }),
        TextAlign.configure({
          types: ['heading', 'paragraph'],
        }),
      ],
      editorProps: {
        attributes: {
          dir: 'rtl',
          class:
            'prose dark:prose-invert max-w-none min-h-[200px] focus:outline-none',
        },
      },
      onUpdate({ editor }) {
        emit('update:modelValue', editor.getHTML())
      },
    })
    
    watch(
      () => props.modelValue,
      (value) => {
        if (editor && value !== editor.getHTML()) {
          editor.commands.setContent(value ?? '', false)
        }
      }
    )
    
    onBeforeUnmount(() => {
      editor?.destroy()
    })
    
    const baseBtn =
      'flex items-center justify-center gap-1 px-2 py-1.5 rounded-md text-sm border transition ' +
      'border-gray-300 dark:border-gray-600 ' +
      'text-gray-700 dark:text-gray-200 ' +
      'hover:bg-gray-100 dark:hover:bg-gray-700'
    
    const activeBtn =
      'bg-gray-900 text-white dark:bg-white dark:text-black'
    
    const divider = 'w-px h-6 bg-gray-300 dark:bg-gray-600 mx-1'
    </script>
    
    <template>
      <div
        class="rounded-xl border
               border-gray-200 dark:border-gray-700
               bg-white dark:bg-gray-900"
      >
        <!-- Toolbar -->
        <div
          class="flex flex-wrap items-center gap-1 p-2 border-b
                 border-gray-200 dark:border-gray-700
                 bg-gray-50 dark:bg-gray-800"
        >
          <!-- ===== Text Style ===== -->
          <button
            title="غامق"
            @click="editor?.chain().focus().toggleBold().run()"
            :class="[baseBtn, editor?.isActive('bold') && activeBtn]"
          >
            <strong>B</strong>
          </button>
    
          <button
            title="مائل"
            @click="editor?.chain().focus().toggleItalic().run()"
            :class="[baseBtn, editor?.isActive('italic') && activeBtn]"
          >
            <em>I</em>
          </button>
    
          <button
            title="تحته خط"
            @click="editor?.chain().focus().toggleUnderline().run()"
            :class="[baseBtn, editor?.isActive('underline') && activeBtn]"
          >
            <span class="underline">U</span>
          </button>
    
          <button
            title="يتوسطه خط"
            @click="editor?.chain().focus().toggleStrike().run()"
            :class="[baseBtn, editor?.isActive('strike') && activeBtn]"
          >
            <span class="line-through">S</span>
          </button>
    
          <div :class="divider" />
    
          <!-- ===== Headings ===== -->
          <button
            title="عنوان رئيسي"
            @click="editor?.chain().focus().toggleHeading({ level: 1 }).run()"
            :class="[baseBtn, editor?.isActive('heading', { level: 1 }) && activeBtn]"
          >
            H1
          </button>
    
          <button
            title="عنوان فرعي"
            @click="editor?.chain().focus().toggleHeading({ level: 2 }).run()"
            :class="[baseBtn, editor?.isActive('heading', { level: 2 }) && activeBtn]"
          >
            H2
          </button>
    
          <button
            title="عنوان صغير"
            @click="editor?.chain().focus().toggleHeading({ level: 3 }).run()"
            :class="[baseBtn, editor?.isActive('heading', { level: 3 }) && activeBtn]"
          >
            H3
          </button>
    
          <div :class="divider" />
    
          <!-- ===== Lists ===== -->
          <button
            title="قائمة نقطية"
            @click="editor?.chain().focus().toggleBulletList().run()"
            :class="[baseBtn, editor?.isActive('bulletList') && activeBtn]"
          >
            • • •
          </button>
    
          <button
            title="قائمة رقمية"
            @click="editor?.chain().focus().toggleOrderedList().run()"
            :class="[baseBtn, editor?.isActive('orderedList') && activeBtn]"
          >
            1.2.3
          </button>
    
          <div :class="divider" />
    
          <!-- ===== Alignment ===== -->
          <button
            title="محاذاة يمين"
            @click="editor?.chain().focus().setTextAlign('right').run()"
            class="px-2 py-1.5 rounded-md border border-gray-300 dark:border-gray-600"
          >
            ⮞
          </button>
    
          <button
            title="توسيط"
            @click="editor?.chain().focus().setTextAlign('center').run()"
            class="px-2 py-1.5 rounded-md border border-gray-300 dark:border-gray-600"
          >
            ≡
          </button>
    
          <button
            title="محاذاة يسار"
            @click="editor?.chain().focus().setTextAlign('left').run()"
            class="px-2 py-1.5 rounded-md border border-gray-300 dark:border-gray-600"
          >
            ⮜
          </button>
    
          <div :class="divider" />
    
          <!-- ===== Quote / Code ===== -->
          <button
            title="اقتباس"
            @click="editor?.chain().focus().toggleBlockquote().run()"
            :class="[baseBtn, editor?.isActive('blockquote') && activeBtn]"
          >
            ❝ ❞
          </button>
    
          <button
            title="كود"
            @click="editor?.chain().focus().toggleCodeBlock().run()"
            :class="[baseBtn, editor?.isActive('codeBlock') && activeBtn]"
          >
            { }
          </button>
    
          <div :class="divider" />
    
          <!-- ===== Undo / Redo ===== -->
          <button title="تراجع" @click="editor?.chain().focus().undo().run()" class="baseBtn">
            ↺
          </button>
    
          <button title="إعادة" @click="editor?.chain().focus().redo().run()" class="baseBtn">
            ↻
          </button>
    
          <!-- ===== Clear ===== -->
          <button
            title="مسح المحتوى"
            @click="editor?.commands.clearContent()"
            class="px-2 py-1.5 rounded-md border border-red-400 text-red-600 hover:bg-red-50"
          >
            ✕
          </button>
        </div>
    
        <!-- Editor -->
        <EditorContent
          :editor="editor"
          class="p-4 text-gray-900 dark:text-gray-100"
        />
      </div>
    </template>
    