<!-- Modal for Terms -->
<div id="termsModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="relative bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300 text-right" dir="rtl">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-stone-50">
            <h3 class="text-2xl font-black text-[#8b6e4b]">قانون المسابقة</h3>
            <button onclick="closeModal()" class="text-3xl text-slate-400 hover:text-slate-800 leading-none">&times;</button>
        </div>
        <div class="p-8 space-y-4 max-h-[70vh] overflow-y-auto modal-scroll text-slate-700 leading-loose">
            <p><b>المادة 01:</b> المسابقة خاصة بجميع شباب ولاية سطيف (ذكور وإناث)، (هواة ومحترفين) الذين تتراوح أعمارهم بين 18 و 35 سنة.</p>
            <p><b>المادة 02:</b> ملء الاستمارة شرط أساسي لطلب المشاركة في المسابقة، من خلالها يتم الانتقاء بناء على اختبار شفهي حيث يتم الاتصال بالمشارك وطرح أسئلة مباشرة تتعلق بالصورة الفوتوغرافية تقنيا وفنيا.</p>
            <p><b>المادة 03:</b> احضار آلة التصوير اجباري لكل مشارك يتم قبوله للمشاركة في المسابقة.</p>
            <p><b>المادة 04:</b> المسابقة ميدانية في الهواء الطلق مع حرية اختيار الموضوع.</p>
            <p><b>المادة 05:</b> كل متسابق له الحق في اختيار صورة واحدة فقط لدخول المنافسة.</p>
            <p><b>المادة 06:</b> يجب ارفاق بطاقة تقنية خاصة بالصورة (النموذج يتم توفيره أثناء المسابقة).</p>
            <p><b>المادة 07:</b> الاعمال المشاركة تخضع لتقييم لجنة التحكيم لاختيار 3 مراتب أولى.</p>
            <p><b>المادة 08:</b> يفتح التصويت عبر مواقع التواصل الاجتماعي ليتم منح جائزة الجمهور بناء على الصورة المتحصلة على عدد أكبر من الأصوات.</p>
            <p><b>المادة 09:</b> تقدر الجائزة الأولى بـ 30000 دج / الجائزة الثانية 25000 دج / الجائزة الثالثة 20000 دج / جائزة الجمهور 15000 دج.</p>
            <p><b>المادة 10:</b> يجب على المشاركين الالتزام ببرنامج الفعالية واحترام المواعيد لضمان السير الجيد للمسابقة.</p>
            <p><b>المادة 11:</b> نتائج لجنة التحكيم غير قابلة للطعن.</p>
            <p><b>المادة 12:</b> إدارة مسابقة حيزية تتكفل بالتنقلات والاطعام والمبيت طيلة أيام المسابقة.</p>
            <div class="mt-6 p-4 bg-amber-50 rounded-xl border-r-4 border-amber-400 text-amber-900">
                <b>تنويه:</b> كل مشارك يتم قبوله لدخول المسابقة سيتم الاتصال به لتأكيد حضوره اذا لم يتم الرد سيستبدل تلقائيا بمشارك آخر.
            </div>
        </div>
        <div class="p-6 bg-slate-50 text-center">
            <button onclick="closeModal()" class="px-8 py-3 bg-stone-800 text-white rounded-xl font-bold hover:bg-stone-700 transition-colors">إغلاق</button>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('termsModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('termsModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('termsModal');
        if (event.target == modal) {
            closeModal();
        }
    });
</script>

<style>
    .modal-scroll::-webkit-scrollbar { width: 6px; }
    .modal-scroll::-webkit-scrollbar-track { background: #f1f1f1; }
    .modal-scroll::-webkit-scrollbar-thumb { background: #8b6e4b; border-radius: 10px; }
</style>
