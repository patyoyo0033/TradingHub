@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-outline-variant/50 bg-white text-black focus:border-indigo-500 dark:focus:border-primary focus:ring-indigo-500 dark:focus:ring-primary rounded-md shadow-sm placeholder-gray-400']) }}>
