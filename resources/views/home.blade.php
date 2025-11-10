@extends('layouts.app')

@section('title', config('app.name') . ' - ' . __('messages.home'))

@section('content')
    <!-- Hero Slider with Swipe Support -->
    <section x-data="{
            idx: 0,
            startX: 0,
            startY: 0,
            isDragging: false,
            progress: 0,
            progressKey: 0,
            slideDuration: 5000,
            slides: @js($sliders->map(fn($s) => [
                'image' => $s->image_path ? asset('storage/'.$s->image_path) : '',
                'title' => app()->getLocale()==='tr' ? ($s->title_tr ?? '') : ($s->title_en ?? ($s->title_tr ?? '')),
                'subtitle' => '',
            ])),
            next(){
                this.idx = (this.idx+1) % this.slides.length;
                this.resetProgress();
            },
            prev(){
                this.idx = (this.idx-1+this.slides.length) % this.slides.length;
                this.resetProgress();
            },
            resetProgress(){
                this.progress = 0;
                this.progressKey++;
                this.startProgress();
            },
            startProgress(){
                const startTime = Date.now();
                const updateProgress = () => {
                    const elapsed = Date.now() - startTime;
                    this.progress = Math.min((elapsed / this.slideDuration) * 100, 100);
                    if(this.progress < 100){
                        requestAnimationFrame(updateProgress);
                    }
                };
                requestAnimationFrame(updateProgress);
            },
            handleTouchStart(e){
                this.startX = e.touches[0].clientX;
                this.startY = e.touches[0].clientY;
                this.isDragging = true;
            },
            handleTouchMove(e){
                if(!this.isDragging) return;
                e.preventDefault();
            },
            handleTouchEnd(e){
                if(!this.isDragging) return;
                const endX = e.changedTouches[0].clientX;
                const endY = e.changedTouches[0].clientY;
                const diffX = this.startX - endX;
                const diffY = Math.abs(this.startY - endY);

                if(Math.abs(diffX) > 50 && Math.abs(diffX) > diffY){
                    if(diffX > 0) this.next();
                    else this.prev();
                }
                this.isDragging = false;
            },
            handleMouseDown(e){
                this.startX = e.clientX;
                this.startY = e.clientY;
                this.isDragging = true;
            },
            handleMouseMove(e){
                if(!this.isDragging) return;
            },
            handleMouseUp(e){
                if(!this.isDragging) return;
                const endX = e.clientX;
                const endY = e.clientY;
                const diffX = this.startX - endX;
                const diffY = Math.abs(this.startY - endY);

                if(Math.abs(diffX) > 50 && Math.abs(diffX) > diffY){
                    if(diffX > 0) this.next();
                    else this.prev();
                }
                this.isDragging = false;
            },
            init(){
                this.startProgress();
                setInterval(()=>{ this.next() }, this.slideDuration);
            },
        }"
        @touchstart="handleTouchStart($event)"
        @touchmove="handleTouchMove($event)"
        @touchend="handleTouchEnd($event)"
        @mousedown="handleMouseDown($event)"
        @mousemove="handleMouseMove($event)"
        @mouseup="handleMouseUp($event)"
        @mouseleave="isDragging = false"
        class="relative select-none cursor-grab active:cursor-grabbing overflow-hidden h-[60vh] md:h-[75vh]">
        <!-- Slides -->
        <template x-for="(s, i) in slides" :key="i">
            <div x-show="idx === i"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-105"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-500"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute inset-0 w-full h-full">
                <div class="absolute inset-0">
                    <img :src="s.image" alt="slide" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/30"></div>
                </div>
                <!-- Text overlay -->
                <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 max-w-5xl w-full px-4 sm:px-6 lg:px-8 text-center text-white">
                    <p class="text-sm md:text-base text-blue-100" x-text="s.subtitle"></p>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold mt-3" x-text="s.title"></h1>
                    <div class="mt-8 flex justify-center gap-4">
                        <a href="{{ route('contact') }}" class="bg-white text-blue-700 px-6 py-3 rounded-md font-semibold hover:bg-blue-50 transition">
                            {{ __('messages.get_quote') }}
                        </a>
                        <a href="{{ route('about') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-blue-500 transition">
                            {{ __('messages.learn_more') }}
                        </a>
                    </div>
                </div>
            </div>
        </template>
        <!-- Progress Circle - top right -->
        <div class="absolute right-4 md:right-6 top-4 md:top-6 z-20">
            <svg class="w-10 h-10 md:w-12 md:h-12 transform -rotate-90" viewBox="0 0 36 36">
                <!-- Background circle -->
                <circle cx="18" cy="18" r="15.915" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>
                <!-- Progress circle -->
                <circle cx="18" cy="18" r="15.915" fill="none"
                        stroke="white"
                        stroke-width="2"
                        stroke-dasharray="100"
                        :stroke-dashoffset="100 - progress"
                        stroke-linecap="round"/>
            </svg>
        </div>
        <!-- Vertical Dots - right center -->
        <div class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 z-20 flex flex-col items-center gap-2">
            <template x-for="(s, i) in slides" :key="'dot-'+i">
                <button @click="idx=i; resetProgress();" :class="idx===i?'bg-white':'bg-white/50'" class="w-2.5 h-2.5 rounded-full transition-all"></button>
            </template>
        </div>
        <!-- Curved bottom decoration -->
        <div class="pointer-events-none absolute left-0 right-0 bottom-[-1px] z-10">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" class="w-full h-[90px] md:h-[120px]">
                <!-- Smooth full-width bottom curve: starts and ends at bottom to avoid side corners -->
                <path fill="#ffffff" d="M0,120 C360,40 1080,40 1440,120 L1440,120 L0,120 Z"/>
            </svg>
        </div>
    </section>

    <!-- Tab Section: Why Choose Us, Mission & Vision, Popular Questions -->
    <section x-data="{ activeTab: 'why' }" class="py-20 bg-white relative overflow-hidden">
        <style>
            @keyframes bubbleUp {
                0% { transform: translateY(0) translateX(0) scale(1); opacity: .0; }
                10% { opacity: .25; }
                50% { opacity: .4; }
                100% { transform: translateY(-120%) translateX(var(--drift, 0)) scale(1.1); opacity: 0; }
            }
            @keyframes bubbleRise {
                0% { transform: translateY(20%) scale(0.8); opacity: 0; }
                30% { opacity: .35; }
                100% { transform: translateY(-120%) scale(1.05); opacity: 0; }
            }
        </style>
        <!-- Water bubbles background -->
        <div class="pointer-events-none absolute inset-0 z-0">
            <div class="absolute bottom-0 left-0 right-0">
                <span class="absolute w-7 h-7 bg-blue-200/40 rounded-full blur-[1px]" style="left:5%; animation:bubbleUp 9s linear infinite; --drift: 20px;"></span>
                <span class="absolute w-5 h-5 bg-blue-300/40 rounded-full blur-[1px]" style="left:12%; animation:bubbleUp 7s linear infinite 1s; --drift: -10px;"></span>
                <span class="absolute w-8 h-8 bg-blue-300/40 rounded-full blur-[1px]" style="left:18%; animation:bubbleUp 10s linear infinite .5s; --drift: 30px;"></span>
                <span class="absolute w-4 h-4 bg-blue-200/50 rounded-full blur-[1px]" style="left:25%; animation:bubbleUp 8s linear infinite 2s; --drift: -20px;"></span>
                <span class="absolute w-10 h-10 bg-blue-200/40 rounded-full blur-[1px]" style="left:32%; animation:bubbleUp 11s linear infinite .8s; --drift: 15px;"></span>
                <span class="absolute w-6 h-6 bg-blue-300/40 rounded-full blur-[1px]" style="left:40%; animation:bubbleUp 9s linear infinite 1.3s; --drift: -25px;"></span>
                <span class="absolute w-7 h-7 bg-blue-200/50 rounded-full blur-[1px]" style="left:47%; animation:bubbleUp 7.5s linear infinite .2s; --drift: 10px;"></span>
                <span class="absolute w-8 h-8 bg-blue-300/40 rounded-full blur-[1px]" style="left:55%; animation:bubbleUp 10s linear infinite 1.1s; --drift: -15px;"></span>
                <span class="absolute w-5 h-5 bg-blue-200/40 rounded-full blur-[1px]" style="left:62%; animation:bubbleUp 8.5s linear infinite .6s; --drift: 22px;"></span>
                <span class="absolute w-7 h-7 bg-blue-300/40 rounded-full blur-[1px]" style="left:70%; animation:bubbleUp 12s linear infinite 1.6s; --drift: -18px;"></span>
                <span class="absolute w-4 h-4 bg-blue-200/40 rounded-full blur-[1px]" style="left:78%; animation:bubbleUp 7.2s linear infinite .4s; --drift: 12px;"></span>
                <span class="absolute w-8 h-8 bg-blue-200/40 rounded-full blur-[1px]" style="left:86%; animation:bubbleUp 10.8s linear infinite 1.9s; --drift: -12px;"></span>
                <span class="absolute w-5 h-5 bg-blue-300/40 rounded-full blur-[1px]" style="left:93%; animation:bubbleUp 8.2s linear infinite .9s; --drift: 16px;"></span>
            </div>
        </div>
        <!-- Decorative background shapes -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-blue-50 rounded-full opacity-30 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-50 rounded-full opacity-30 blur-3xl"></div>
        <div class="absolute top-0 right-0 w-80 h-80 bg-blue-50 rounded-full opacity-20 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Tabs Navigation -->
            <div class="flex flex-col md:flex-row justify-center items-center mb-12 gap-2">
                <button @click="activeTab = 'why'"
                        :class="activeTab === 'why' ? 'bg-blue-700 text-white' : 'bg-white text-gray-700'"
                        class="w-full md:flex-1 px-6 py-3 rounded-lg font-semibold transition-all relative overflow-hidden">
                    <span class="relative z-10">1. {{ __('messages.why_choose_us_tab') }}</span>
                    <!-- bubbles inside button -->
                    <span class="pointer-events-none absolute inset-0">
                        <span class="absolute bottom-0 left-3 w-3 h-3 bg-blue-200/60 rounded-full" style="animation:bubbleRise 3.8s linear infinite;"></span>
                        <span class="absolute bottom-0 left-6 w-2.5 h-2.5 bg-blue-300/60 rounded-full" style="animation:bubbleRise 3.2s linear infinite .6s;"></span>
                        <span class="absolute bottom-0 left-10 w-3 h-3 bg-blue-300/50 rounded-full" style="animation:bubbleRise 4s linear infinite .2s;"></span>
                        <span class="absolute bottom-0 left-1/2 w-2.5 h-2.5 bg-blue-200/60 rounded-full" style="animation:bubbleRise 3.4s linear infinite .9s;"></span>
                        <span class="absolute bottom-0 right-8 w-3 h-3 bg-blue-300/60 rounded-full" style="animation:bubbleRise 3.6s linear infinite .3s;"></span>
                    </span>

                </button>

                <button @click="activeTab = 'mission'"
                        :class="activeTab === 'mission' ? 'bg-blue-700 text-white' : 'bg-white text-gray-700'"
                        class="w-full md:flex-1 px-6 py-3 rounded-lg font-semibold transition-all relative overflow-hidden">
                    <span class="relative z-10">2. {{ __('messages.mission_vision_tab') }}</span>
                    <span class="pointer-events-none absolute inset-0">
                        <span class="absolute bottom-0 left-4 w-3 h-3 bg-blue-200/60 rounded-full" style="animation:bubbleRise 3.5s linear infinite .2s;"></span>
                        <span class="absolute bottom-0 left-8 w-2.5 h-2.5 bg-blue-300/60 rounded-full" style="animation:bubbleRise 3s linear infinite .7s;"></span>
                        <span class="absolute bottom-0 left-14 w-3 h-3 bg-blue-300/50 rounded-full" style="animation:bubbleRise 4.1s linear infinite .1s;"></span>
                        <span class="absolute bottom-0 left-1/2 w-2.5 h-2.5 bg-blue-200/60 rounded-full" style="animation:bubbleRise 3.7s linear infinite .8s;"></span>
                        <span class="absolute bottom-0 right-10 w-3 h-3 bg-blue-300/60 rounded-full" style="animation:bubbleRise 3.9s linear infinite .4s;"></span>
                    </span>

                </button>

                <button @click="activeTab = 'faq'"
                        :class="activeTab === 'faq' ? 'bg-blue-700 text-white' : 'bg-white text-gray-700'"
                        class="w-full md:flex-1 px-6 py-3 rounded-lg font-semibold transition-all relative overflow-hidden">
                    <span class="relative z-10">3. {{ __('messages.popular_questions_tab') }}</span>
                    <span class="pointer-events-none absolute inset-0">
                        <span class="absolute bottom-0 left-5 w-3 h-3 bg-blue-200/60 rounded-full" style="animation:bubbleRise 3.6s linear infinite .1s;"></span>
                        <span class="absolute bottom-0 left-9 w-2.5 h-2.5 bg-blue-300/60 rounded-full" style="animation:bubbleRise 3.1s linear infinite .5s;"></span>
                        <span class="absolute bottom-0 left-16 w-3 h-3 bg-blue-300/50 rounded-full" style="animation:bubbleRise 3.8s linear infinite .3s;"></span>
                        <span class="absolute bottom-0 left-1/2 w-2.5 h-2.5 bg-blue-200/60 rounded-full" style="animation:bubbleRise 3.9s linear infinite .7s;"></span>
                        <span class="absolute bottom-0 right-7 w-3 h-3 bg-blue-300/60 rounded-full" style="animation:bubbleRise 4.2s linear infinite .2s;"></span>
                    </span>

                </button>
            </div>

            <!-- Tab Content: Why Choose Us -->
            <div x-show="activeTab === 'why'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="mb-12">
                <div class="text-center mb-12">
                    <p class="text-blue-500 text-sm font-medium mb-2">{{ __('messages.with_experience') }}</p>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800">{{ __('messages.why_choose_us_tab') }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white p-6 rounded-lg">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('messages.years_service') }}</h3>
                        <p class="text-gray-600">{{ __('messages.years_service_desc') }}</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-6 rounded-lg">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('messages.quality_guarantee') }}</h3>
                        <p class="text-gray-600">{{ __('messages.quality_guarantee_desc') }}</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-6 rounded-lg">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('messages.experienced_technicians') }}</h3>
                        <p class="text-gray-600">{{ __('messages.experienced_technicians_desc') }}</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-white p-6 rounded-lg">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('messages.expert_repairs') }}</h3>
                        <p class="text-gray-600">{{ __('messages.expert_repairs_desc') }}</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-white p-6 rounded-lg">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('messages.total_clean') }}</h3>
                        <p class="text-gray-600">{{ __('messages.total_clean_desc') }}</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-white p-6 rounded-lg">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('messages.request_estimate') }}</h3>
                        <p class="text-gray-600">{{ __('messages.request_estimate_desc') }}</p>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Mission & Vision -->
            <div x-show="activeTab === 'mission'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="mb-12">
                <div class="text-center mb-12">
                    <p class="text-blue-500 text-sm font-medium mb-2">{{ __('messages.understanding_customers') }}</p>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800">{{ __('messages.mission_vision_tab') }}</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Left Column -->
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ __('messages.mission_statement') }}</h3>
                            <p class="text-gray-600 leading-relaxed">{{ __('messages.mission_content') }}</p>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ __('messages.vision_statement') }}</h3>
                            <p class="text-gray-600 leading-relaxed">{{ __('messages.vision_content') }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">{{ __('messages.core_values') }}</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <p class="text-gray-600">{{ __('messages.core_value_1') }}</p>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <p class="text-gray-600">{{ __('messages.core_value_2') }}</p>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <p class="text-gray-600">{{ __('messages.core_value_3') }}</p>
                            </li>
                        </ul>

                        <!-- Illustration Placeholder -->
                        <div class="mt-8 bg-blue-50 rounded-lg p-8 flex items-center justify-center h-64">
                            <svg class="w-32 h-32 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Popular Questions -->
            <div x-show="activeTab === 'faq'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="mb-12">
                <div class="text-center mb-12">
                    <p class="text-blue-500 text-sm font-medium mb-2">{{ __('messages.frequently_asked') }}</p>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800">{{ __('messages.popular_questions_tab') }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                            <h3 class="text-lg font-bold text-gray-800">{{ __('messages.faq_1') }}</h3>
                            <svg class="w-5 h-5 text-gray-600 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-96"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-96"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="mt-4 text-gray-600 overflow-hidden">
                            <p>{{ __('messages.faq_1_answer') }}</p>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                            <h3 class="text-lg font-bold text-gray-800">{{ __('messages.faq_2') }}</h3>
                            <svg class="w-5 h-5 text-gray-600 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-96"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-96"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="mt-4 text-gray-600 overflow-hidden">
                            <p>{{ __('messages.faq_2_answer') }}</p>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                            <h3 class="text-lg font-bold text-gray-800">{{ __('messages.faq_3') }}</h3>
                            <svg class="w-5 h-5 text-gray-600 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-96"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-96"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="mt-4 text-gray-600 overflow-hidden">
                            <p>{{ __('messages.faq_3_answer') }}</p>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                            <h3 class="text-lg font-bold text-gray-800">{{ __('messages.faq_4') }}</h3>
                            <svg class="w-5 h-5 text-gray-600 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-96"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-96"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="mt-4 text-gray-600 overflow-hidden">
                            <p>{{ __('messages.faq_4_answer') }}</p>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                            <h3 class="text-lg font-bold text-gray-800">{{ __('messages.faq_5') }}</h3>
                            <svg class="w-5 h-5 text-gray-600 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-96"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-96"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="mt-4 text-gray-600 overflow-hidden">
                            <p>{{ __('messages.faq_5_answer') }}</p>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <button @click="open = !open" class="w-full flex items-center justify-between text-left">
                            <h3 class="text-lg font-bold text-gray-800">{{ __('messages.faq_6') }}</h3>
                            <svg class="w-5 h-5 text-gray-600 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-96"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-96"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="mt-4 text-gray-600 overflow-hidden">
                            <p>{{ __('messages.faq_6_answer') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ __('messages.our_services') }}</h2>
                <p class="text-xl text-gray-600">{{ __('messages.our_services_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('messages.pool_design') }}</h3>
                    <p class="text-gray-600">{{ __('messages.pool_design_desc') }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('messages.pool_construction') }}</h3>
                    <p class="text-gray-600">{{ __('messages.pool_construction_desc') }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('messages.pool_maintenance') }}</h3>
                    <p class="text-gray-600">{{ __('messages.pool_maintenance_desc') }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('messages.pool_renovation') }}</h3>
                    <p class="text-gray-600">{{ __('messages.pool_renovation_desc') }}</p>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('services') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    {{ __('messages.learn_more') }}
                </a>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section x-data="{ activeFilter: 'all' }" class="py-20 bg-white relative overflow-hidden">
        <!-- Decorative background shapes -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-blue-50 rounded-full opacity-30 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="text-center mb-12">
                <p class="text-blue-500 text-sm font-medium mb-2">{{ __('messages.featured_projects') }}</p>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800">{{ __('messages.pool_designs_featured') }}</h2>
            </div>

            <!-- Filter Navigation -->
            <div class="flex flex-wrap justify-center gap-4 md:gap-6 mb-12">
                <button @click="activeFilter = 'all'"
                        :class="activeFilter === 'all' ? 'text-blue-700 font-semibold border-b-2 border-blue-700 pb-1' : 'text-gray-600 hover:text-gray-800'"
                        class="text-lg transition-all">
                    {{ __('messages.filter_all') }}
                </button>
                @foreach($portfolioCategories as $cat)
                    @php($catId = 'cat-'.$cat->id)
                    <button @click="activeFilter = '{{ $catId }}'"
                            :class="activeFilter === '{{ $catId }}' ? 'text-blue-700 font-semibold border-b-2 border-blue-700 pb-1' : 'text-gray-600 hover:text-gray-800'"
                            class="text-lg transition-all">
                        {{ app()->getLocale()==='tr' ? $cat->name_tr : ($cat->name_en ?? $cat->name_tr) }}
                    </button>
                @endforeach
            </div>

            <!-- Portfolio Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($portfolios as $p)
                    @php($pf = 'cat-'.($p->portfolio_category_id ?? 0))
                    <div x-show="activeFilter === 'all' || activeFilter === '{{ $pf }}'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all">
                        <a href="{{ asset('storage/'.$p->image_path) }}"
                           data-fancybox="portfolio"
                           data-type="image"
                           data-src="{{ asset('storage/'.$p->image_path) }}"
                           data-caption="{{ app()->getLocale()==='tr' ? ($p->title_tr ?? '') : ($p->title_en ?? ($p->title_tr ?? '')) }}">
                            <img src="{{ asset('storage/'.$p->image_path) }}"
                                 alt="{{ app()->getLocale()==='tr' ? ($p->title_tr ?? '') : ($p->title_en ?? ($p->title_tr ?? '')) }}"
                                 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300"></div>
                            <div class="pointer-events-none absolute inset-0 flex items-center justify-center p-4">
                                <div class="opacity-0 translate-y-3 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 text-center">
                                    <div class="inline-block bg-black/60 backdrop-blur-sm text-white text-sm sm:text-base md:text-lg font-semibold rounded px-3 py-2">
                                        {{ app()->getLocale()==='tr' ? ($p->title_tr ?? '') : ($p->title_en ?? ($p->title_tr ?? '')) }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Quote & Statistics Section -->
    <section id="quote" class="py-20 bg-gradient-to-br from-blue-50 to-gray-100 relative overflow-hidden scroll-mt-28 md:scroll-mt-36">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Left Column - Statistics -->
                <div class="relative">
                    <!-- Decorative Wave Overlay -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 400 400" preserveAspectRatio="none">
                            <path d="M0,100 Q100,50 200,100 T400,100 L400,400 L0,400 Z" fill="white"/>
                            <path d="M0,150 Q150,100 300,150 T600,150 L600,400 L0,400 Z" fill="white" opacity="0.7"/>
                        </svg>
                    </div>

                    <div class="relative grid grid-cols-2 gap-8">
                        <!-- Statistic 1: Years Experience -->
                        <div class="text-center">
                            <div class="w-20 h-20 bg-blue-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <span class="text-white text-2xl font-bold">15+</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ app()->getLocale() === 'tr' ? 'Yıl Deneyim' : 'Years Experience' }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ __('messages.years_experience_desc') }}</p>
                        </div>

                        <!-- Statistic 2: Completed Projects -->
                        <div class="text-center">
                            <div class="w-20 h-20 bg-blue-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <span class="text-white text-2xl font-bold">100+</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ app()->getLocale() === 'tr' ? 'Tamamlanan Proje' : 'Completed Projects' }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ __('messages.completed_projects_desc') }}</p>
                        </div>

                        <!-- Statistic 3: Customer Satisfaction -->
                        <div class="text-center">
                            <div class="w-20 h-20 bg-blue-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <span class="text-white text-2xl font-bold">100%</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ app()->getLocale() === 'tr' ? 'Müşteri Memnuniyeti' : 'Customer Satisfaction' }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ __('messages.customer_satisfaction_desc') }}</p>
                        </div>

                        <!-- Statistic 4: Support -->
                        <div class="text-center">
                            <div class="w-20 h-20 bg-blue-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <span class="text-white text-2xl font-bold">24/7</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ app()->getLocale() === 'tr' ? 'Destek' : 'Support' }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ __('messages.support_desc') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Quote Form -->
                <div class="bg-white rounded-lg shadow-xl p-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">
                        @if(app()->getLocale() === 'tr')
                            <span class="text-blue-600 font-bold">ÜCRETSİZ</span> Teklif Al
                        @else
                            Get a <span class="text-blue-600 font-bold">FREE</span> Quote
                        @endif
                    </h2>

                    <form x-data="{ isSubmitting:false }" x-ref="quoteForm" @submit.prevent="isSubmitting=true; setTimeout(()=> $refs.quoteForm.submit(), 800)" class="space-y-4" method="POST" action="{{ route('offers.store') }}">
                        @csrf
                        <!-- Name -->
                        <div>
                            <input type="text" name="name"
                                   placeholder="{{ __('messages.your_name') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Email & Phone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <input type="email" name="email"
                                       placeholder="{{ __('messages.e_mail') }}"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <input type="tel" name="phone"
                                       placeholder="{{ __('messages.phone_number') }}"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <input type="text" name="address"
                                   placeholder="{{ __('messages.your_address') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Service -->
                        <div class="relative">
                            <select name="service" class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none">
                                <option value="">{{ __('messages.service_type') }}</option>
                                <option value="design">{{ __('messages.pool_design') }}</option>
                                <option value="construction">{{ __('messages.pool_construction') }}</option>
                                <option value="maintenance">{{ __('messages.pool_maintenance') }}</option>
                                <option value="renovation">{{ __('messages.pool_renovation') }}</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>



                        <!-- Submit Button -->
                        <button :disabled="isSubmitting" type="submit" class="shimmer-button w-full bg-orange-500 hover:bg-orange-600 disabled:opacity-70 disabled:cursor-not-allowed text-white font-semibold py-3 rounded-lg transition-all shadow-lg flex items-center justify-center gap-2 relative z-10">
                            <template x-if="!isSubmitting">
                                <span class="relative z-10">Talep Oluştur</span>
                            </template>
                            <template x-if="!isSubmitting">
                                <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </template>
                            <template x-if="isSubmitting">
                                <svg class="w-5 h-5 animate-spin relative z-10" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                            </template>
                            <template x-if="isSubmitting">
                                <span class="relative z-10">Gönderiliyor...</span>
                            </template>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>



    <!-- Scroll to Top Button -->
    <button x-data="{ show: false }"
            @scroll.window="show = window.scrollY > 300"
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-75"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-75"
            class="fixed bottom-8 right-8 bg-blue-600 text-white rounded-full p-4 shadow-lg hover:bg-blue-700 transition-all z-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
@endsection

