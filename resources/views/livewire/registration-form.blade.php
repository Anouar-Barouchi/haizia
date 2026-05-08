<div class="glass-card max-w-2xl w-full rounded-2xl shadow-2xl overflow-hidden border-t-8 border-[#8b6e4b] bg-white">
    
    <!-- Header -->
    <div class="p-8 text-center bg-white/50">
        <img src="{{ asset('logo-original.png') }}" class="h-32 mx-auto mb-4 drop-shadow-md" alt="Logo">
        <h1 class="text-3xl font-extrabold text-[#8b6e4b] mb-2">استمارة التسجيل في المسابقة</h1>
        <p class="text-slate-600 font-bold">21 - 22 - 23 ماي 2026</p>
        
        <!-- Setif Only Notice -->
        <div class="mt-4 bg-amber-50 border-r-4 border-amber-500 p-4 rounded-lg flex items-center gap-3 text-right">
            <span class="text-amber-600 text-xl font-bold">⚠️</span>
            <p class="text-amber-800 font-bold text-sm sm:text-base">
                تنبيه: المسابقة موجهة حصرياً لشباب ولاية سطيف فقط.
            </p>
        </div>
    </div>

    @if($successMessage)
        <div class="p-8 text-center animate-bounce">
            <div class="bg-green-100 border-r-4 border-green-500 p-6 rounded-2xl shadow-sm">
                <p class="text-green-800 font-black text-xl">{{ $successMessage }}</p>
            </div>
            <button wire:click="$set('successMessage', null)" class="mt-4 text-slate-500 underline">إرسال طلب آخر</button>
        </div>
    @else
        <form wire:submit.prevent="submit" class="p-8 space-y-8 text-right" dir="rtl">
            
            <!-- Section: Personal Info -->
            <div>
                <div class="flex items-center gap-3 mb-6 bg-stone-50 p-2 rounded-lg border-r-4 border-[#8b6e4b]">
                    <h2 class="text-xl font-bold text-slate-800">المعلومات الشخصية</h2>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-600">الاسم</label>
                        <input type="text" wire:model="first_name" required placeholder="اسمه الشخصي" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-stone-400 outline-none transition-all @error('first_name') border-red-500 @enderror">
                        @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-600">اللقب</label>
                        <input type="text" wire:model="last_name" required placeholder="لقب العائلة"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-stone-400 outline-none transition-all @error('last_name') border-red-500 @enderror">
                        @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 space-y-2">
                    <label class="block text-sm font-bold text-slate-600">تاريخ الميلاد</label>
                    <input type="date" wire:model="birth_date" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-stone-400 outline-none transition-all">
                </div>

                <div class="mt-6 space-y-2">
                    <label class="block text-sm font-bold text-slate-600">العنوان بالتفصيل (داخل ولاية سطيف)</label>
                    <input type="text" wire:model="address" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-stone-400 outline-none transition-all">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-600">رقم الهاتف</label>
                        <input type="tel" wire:model="phone" required placeholder="06XXXXXXXX"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-stone-400 outline-none transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-600">البريد الإلكتروني</label>
                        <input type="email" wire:model="email" required placeholder="example@email.com"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-stone-400 outline-none transition-all @error('email') border-red-500 @enderror">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Profile Pic -->
            <div>
                <div class="flex items-center gap-3 mb-6 bg-stone-50 p-2 rounded-lg border-r-4 border-[#8b6e4b]">
                    <h2 class="text-xl font-bold text-slate-800">الصورة الشخصية</h2>
                </div>
                <div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer group relative" onclick="document.getElementById('profile_pic').click()">
                    <input type="file" id="profile_pic" wire:model="profile_pic" accept="image/*" class="hidden">
                    
                    @if($profile_pic)
                        <img src="{{ $profile_pic->temporaryUrl() }}" class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-[#8b6e4b] shadow-lg mb-4">
                    @else
                        <div class="space-y-3">
                            <svg class="w-12 h-12 mx-auto text-slate-400 group-hover:text-[#8b6e4b] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-slate-600 font-semibold">اختر صورة بروفايل احترافية</p>
                            <p class="text-xs text-slate-400">ستستخدم في التعريف بالمتسابقين</p>
                        </div>
                    @endif
                    
                    <div wire:loading wire:target="profile_pic" class="text-sm text-stone-500 mt-2">جاري التحميل...</div>
                </div>
                @error('profile_pic') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Section: Membership -->
            <div class="space-y-4">
                <label class="block text-lg font-bold text-slate-800">منخرط في:</label>
                <div class="flex flex-wrap gap-4">
                    @foreach(['مؤسسة شبانية', 'جمعية', 'حر'] as $option)
                        <label class="flex items-center gap-2 cursor-pointer bg-white px-5 py-3 rounded-xl border border-slate-200 hover:border-[#8b6e4b] transition-all">
                            <input type="radio" wire:model.live="membership" value="{{ $option }}" class="w-4 h-4 text-[#8b6e4b] focus:ring-[#8b6e4b]">
                            <span class="font-semibold text-slate-700">{{ $option }}</span>
                        </label>
                    @endforeach
                </div>
                
                @if($membership !== 'حر')
                    <div class="animate-fade-in mt-4">
                        <label class="block text-sm font-bold text-slate-600 mb-2">
                            {{ $membership === 'جمعية' ? 'اسم الجمعية' : 'اسم المؤسسة الشبانية' }}
                        </label>
                        <input type="text" wire:model="membership_name" placeholder="أدخل الاسم هنا..."
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-stone-400 outline-none transition-all">
                    </div>
                @endif
            </div>

            <!-- Section: Experience -->
            <div>
                <div class="flex items-center gap-3 mb-6 bg-stone-50 p-2 rounded-lg border-r-4 border-[#8b6e4b]">
                    <h2 class="text-xl font-bold text-slate-800">الخبرة والمشاركات</h2>
                </div>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-600">هل شاركت في مسابقات خاصة بالصورة الفوتوغرافية؟</label>
                        <select wire:model.live="has_experience"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none transition-all appearance-none bg-white">
                            <option value="لا">لا</option>
                            <option value="نعم">نعم</option>
                        </select>
                    </div>

                    @if($has_experience === 'نعم')
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-600">اذكر المشاركات:</label>
                            <textarea wire:model="experience_list" rows="3" placeholder="أدخل أسماء المسابقات التي شاركت فيها..."
                                      class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-stone-400"></textarea>
                        </div>
                    @endif

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-600">هل تحصلت على جوائز من خلال المشاركات؟</label>
                        <select wire:model.live="has_awards"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none transition-all appearance-none bg-white">
                            <option value="لا">لا</option>
                            <option value="نعم">نعم</option>
                        </select>
                    </div>

                    @if($has_awards === 'نعم')
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-600">اذكر المراتب المتحصل عليها:</label>
                            <textarea wire:model="awards_list" rows="3" placeholder="مثال: المركز الأول في مسابقة..."
                                      class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-stone-400"></textarea>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section: Previous Work (Gallery) -->
            <div>
                <div class="flex items-center gap-3 mb-6 bg-stone-50 p-2 rounded-lg border-r-4 border-[#8b6e4b]">
                    <h2 class="text-xl font-bold text-slate-800">أعمال سابقة</h2>
                </div>
                <div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer group" onclick="document.getElementById('gallery').click()">
                    <input type="file" id="gallery" wire:model="gallery" accept="image/*" multiple class="hidden">
                    <div class="space-y-3">
                        <svg class="w-12 h-12 mx-auto text-slate-400 group-hover:text-[#8b6e4b] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-slate-600 font-semibold">تحميل عينة من أعمالك السابقة</p>
                        <p class="text-amber-600 text-sm font-bold">⚠️ يمكنك اختيار 3 صور كحد أقصى</p>
                    </div>
                    <div wire:loading wire:target="gallery" class="text-sm text-stone-500 mt-2">جاري التحميل...</div>
                </div>
                
                @if($gallery)
                    <div class="grid grid-cols-3 gap-4 mt-6">
                        @foreach($gallery as $photo)
                            <div class="aspect-square rounded-xl overflow-hidden border-2 border-stone-200 shadow-sm">
                                <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
                @error('gallery') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Terms and Submit -->
            <div class="pt-6 space-y-6">
                <div class="bg-stone-50 p-4 rounded-xl text-sm text-slate-600 leading-relaxed italic border-r-4 border-amber-400">
                    <b>تنويه هام:</b> سيتم الاتصال بالراغبين في المشاركة للمرور باختبار شفهي عبر الهاتف، ليتم بعدها اختيار 24 متسابقاً فقط للمنافسة على 4 جوائز قيّمة.
                </div>

                <div class="flex items-start gap-3 p-2">
                    <input type="checkbox" wire:model="terms" id="terms" required class="mt-1 w-5 h-5 text-[#8b6e4b] rounded focus:ring-[#8b6e4b] cursor-pointer">
                    <label for="terms" class="text-slate-700 font-medium select-none cursor-pointer">
                        لقد قرأت <span class="text-[#8b6e4b] underline font-bold hover:text-stone-700" onclick="openModal()">شروط المسابقة</span> ووافقت عليها
                    </label>
                </div>
                @error('terms') <span class="text-red-500 text-xs">يجب الموافقة على الشروط للمتابعة</span> @enderror

                <button type="submit" wire:loading.attr="disabled" class="w-full bg-[#8b6e4b] hover:bg-stone-800 disabled:bg-stone-300 text-white font-black py-5 rounded-2xl text-xl shadow-xl transform transition-all active:scale-95">
                    إرسال طلب التسجيل
                </button>
            </div>
        </form>
    @endif

    <script>
        let registrationFormStartedTracked = false;

        document.addEventListener('focusin', event => {
            if (registrationFormStartedTracked) {
                return;
            }

            if (event.target.closest('form') && typeof window.trackMetaCustomEvent === 'function') {
                window.trackMetaCustomEvent('RegistrationFormStarted', {
                    form_name: 'contest_registration'
                });
                registrationFormStartedTracked = true;
            }
        });

        window.addEventListener('candidate-registered', event => {
            if (typeof window.trackMetaEvent === 'function') {
                window.trackMetaEvent('CompleteRegistration', {
                    content_name: 'contest_registration',
                    status: 'submitted'
                });

                window.trackMetaEvent('Lead', {
                    content_name: 'contest_registration',
                    membership_type: event.detail?.membership ?? 'unknown',
                    has_experience: event.detail?.has_experience ?? false,
                    has_awards: event.detail?.has_awards ?? false
                });
            }

            if (typeof window.trackMetaCustomEvent === 'function') {
                window.trackMetaCustomEvent('CandidateRegistrationSubmitted', {
                    membership_type: event.detail?.membership ?? 'unknown',
                    has_experience: event.detail?.has_experience ?? false,
                    has_awards: event.detail?.has_awards ?? false
                });
            }
        });
    </script>
</div>
