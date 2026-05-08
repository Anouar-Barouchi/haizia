@extends('layouts.app')

@section('title', 'مسابقة حيزية - قريباً')

@section('content')
<style>
    body { background: radial-gradient(circle at center, #2c3e50, #000) !important; color: white !important; }
    .gold-text { color: #c5a059; }
    .gold-btn { background-color: #8b6e4b; transition: all 0.3s; }
    .gold-btn:hover { background-color: #c5a059; transform: translateY(-2px); }
</style>

<div class="space-y-8 animate-in fade-in duration-1000 text-center">
    <img src="{{ asset('logo-original1.png') }}" class="h-48 mx-auto drop-shadow-[0_0_20px_rgba(197,160,89,0.5)]" alt="Logo">

    <h1 class="text-5xl font-black mb-4">مسابقة حيزية للصورة الفوتوغرافية</h1>
    <p class="text-2xl gold-text font-bold">قريباً جداً...</p>

    <!-- Countdown Timer -->
    <div class="grid grid-cols-4 gap-4 max-w-lg mx-auto py-6" id="countdown-timer">
        <div class="bg-white/5 backdrop-blur-lg p-4 rounded-2xl border border-white/10">
            <span id="d" class="text-4xl font-black gold-text block leading-none">00</span>
            <span class="text-[10px] uppercase text-slate-400 font-bold">يوم</span>
        </div>
        <div class="bg-white/5 backdrop-blur-lg p-4 rounded-2xl border border-white/10">
            <span id="h" class="text-4xl font-black gold-text block leading-none">00</span>
            <span class="text-[10px] uppercase text-slate-400 font-bold">ساعة</span>
        </div>
        <div class="bg-white/5 backdrop-blur-lg p-4 rounded-2xl border border-white/10">
            <span id="m" class="text-4xl font-black gold-text block leading-none">00</span>
            <span class="text-[10px] uppercase text-slate-400 font-bold">دقيقة</span>
        </div>
        <div class="bg-white/5 backdrop-blur-lg p-4 rounded-2xl border border-white/10">
            <span id="s" class="text-4xl font-black gold-text block leading-none">00</span>
            <span class="text-[10px] uppercase text-slate-400 font-bold">ثانية</span>
        </div>
    </div>

    <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 inline-block text-white">
        <p class="text-xl mb-4">موعد الحدث:</p>
        <p class="text-4xl font-black gold-text">21 - 22 - 23 ماي 2026</p>
        <p class="mt-4 text-slate-300">ولاية سطيف</p>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="/register" class="gold-btn px-10 py-4 rounded-2xl font-black text-xl shadow-lg text-white no-underline">
            سجل الآن
        </a>
        <button onclick="openModal()" class="bg-white/10 hover:bg-white/20 px-10 py-4 rounded-2xl font-bold text-xl backdrop-blur-sm transition-all border border-white/10 text-white cursor-pointer">
            شروط المسابقة
        </button>
    </div>

    <div class="mt-12 text-slate-500 text-sm">
        &copy; 2026 جميع الحقوق محفوظة لمديرية الشباب والرياضة - سطيف
    </div>
</div>

<script>
    const targetDate = new Date("May 21, 2026 09:00:00").getTime();
    const timer = setInterval(function() {
        const now = new Date().getTime();
        const diff = targetDate - now;

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        document.getElementById("d").innerHTML = days.toString().padStart(2, '0');
        document.getElementById("h").innerHTML = hours.toString().padStart(2, '0');
        document.getElementById("m").innerHTML = minutes.toString().padStart(2, '0');
        document.getElementById("s").innerHTML = seconds.toString().padStart(2, '0');

        if (diff < 0) {
            clearInterval(timer);
            document.getElementById("countdown-timer").innerHTML = "<p class='text-2xl gold-text font-bold'>بدأت المسابقة!</p>";
        }
    }, 1000);
</script>
@endsection
