<article class="my-4 border rounded shadow border-gray4 first:mt-0">
    <h2 class="!mb-2 !my-0 bg-gray2 block !text-gray5 !font-medium text-center px-2 py-4 !text-lg2 lg:!text-xl"><?php echo $attributes['titel']; ?></h2>
    <div class="p-4">
        <div class="pb-5 text-center">
            <span class="block"><?php echo $attributes['interval-1']; ?></span>
            <span class="block font-bold text-m3xl xl:text-3xl"><?php echo $attributes['tarief']; ?></span>
            <span class="block text-gray5 text-small"><?php echo $attributes['interval-uitleg-1']; ?></span>
        </div>
        <div class="pt-5 text-center border-t border-t-gray4">
            <span class="block"><?php echo $attributes['interval-2']; ?></span>
            <span class="block font-bold text-m3xl xl:text-3xl"><?php echo $attributes['tarief-2']; ?></span>
            <span class="block text-gray5 text-small"><?php echo $attributes['interval-uitleg-2']; ?></span>
        </div>
    </div>
</article>