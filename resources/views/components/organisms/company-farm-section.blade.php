<section class="py-20 relative overflow-hidden">
    {{-- Background - Getting darker (dark blue to very dark) --}}
    <div class="absolute inset-0 bg-gradient-to-b from-blue-900 via-blue-950 to-gray-950"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            {{-- Left Side: Image Grid (Multiple images at once) --}}
            <div class="order-2 md:order-1">
                <div class="grid grid-cols-2 gap-4">
                    {{-- Large image spanning 2 columns --}}
                    <div class="col-span-2 aspect-video rounded-2xl overflow-hidden relative group">
                        <img
                            src="https://images.unsplash.com/photo-1524704654690-b56c05c78a00?w=800"
                            alt="Fish Farm Main Facility"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white font-bold text-xl">Main Facility</h3>
                                <p class="text-gray-200 text-sm">Modern farm in Bekasi</p>
                            </div>
                        </div>
                    </div>

                    {{-- Two smaller images side by side --}}
                    <div class="aspect-square rounded-2xl overflow-hidden relative group">
                        <img
                            src="https://images.unsplash.com/photo-1535591273668-578e31182c4f?w=600"
                            alt="Aquarium Tanks"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="text-white font-bold">Aquarium Tanks</h3>
                                <p class="text-gray-200 text-xs">Specialized systems</p>
                            </div>
                        </div>
                    </div>

                    <div class="aspect-square rounded-2xl overflow-hidden relative group">
                        <img
                            src="https://images.unsplash.com/photo-1520990623178-dc3a6b1dd137?w=600"
                            alt="Fish Care Area"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="text-white font-bold">Care Facilities</h3>
                                <p class="text-gray-200 text-xs">Professional care</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Side: Text Content (Reversed for zig-zag) --}}
            <div class="space-y-8 order-1 md:order-2">
                {{-- Title --}}
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-amber-500 mb-4">Our Farm</h2>
                    <p class="text-xl text-gray-300">State-of-the-Art Facilities in Bekasi</p>
                </div>

                {{-- Text Content --}}
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">Strategic Location</h3>
                            <p class="text-gray-300 leading-relaxed text-lg">
                                Our Fishes Farm is located in Bekasi, it is a small suburban city near Jakarta. This strategic location allows us to efficiently manage our operations and expedite shipments worldwide.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0"></div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">Extensive Infrastructure</h3>
                            <p class="text-gray-300 leading-relaxed text-lg">
                                We have hundreds of aquarium and tanks to cover all of our fishes stocks. Besides, we have many other facilities to support us in doing business and ensuring the best care for our aquatic life.
                            </p>
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-6 pt-4">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-amber-500 mb-2">100+</div>
                            <div class="text-sm text-gray-400">Aquarium Tanks</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-amber-500 mb-2">500+</div>
                            <div class="text-sm text-gray-400">Fish Species</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-amber-500 mb-2">35+</div>
                            <div class="text-sm text-gray-400">Years Experience</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
