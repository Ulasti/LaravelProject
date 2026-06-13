@extends('layouts.userbase')

@section('title', 'Profile - ' . config('app.name'))
@section('page_title', 'Profile')

@section('breadcrumbs')
    <a href="{{ route('user.home') }}" class="text-gray-500 hover:text-gray-900">Dashboard</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">Profile</span>
@endsection

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
            <p class="text-green-700 text-sm">{{ session('success') }}</p>
            <button @click="show = false" class="text-green-500 hover:text-green-700">&times;</button>
        </div>
    @endif

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-4">
                <h3 class="text-base font-semibold text-gray-900">Profile Information</h3>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-300 @enderror">
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-300 @enderror">
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Save Changes</button>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-4">
                <h3 class="text-base font-semibold text-gray-900">Shipping Address</h3>

                <div x-data="{
                    code: '{{ old('phone_code', Auth::user()->phone ? explode(' ', Auth::user()->phone)[0] : '+1') }}',
                    number: '{{ old('phone_number', Auth::user()->phone ? substr(Auth::user()->phone, strpos(Auth::user()->phone,' ')+1) : '') }}',
                    formatNum(val) {
                        let digits = val.replace(/\D/g, '').substring(0, 10);
                        let parts = [];
                        if (digits.length > 0) parts.push(digits.substring(0, 3));
                        if (digits.length > 3) parts.push(digits.substring(3, 6));
                        if (digits.length > 6) parts.push(digits.substring(6, 8));
                        if (digits.length > 8) parts.push(digits.substring(8, 10));
                        return parts.join(' ');
                    }
                }">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <div class="flex space-x-2">
                        <select x-model="code" class="w-24 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="+1">🇺🇸 +1</option>
                            <option value="+44">🇬🇧 +44</option>
                            <option value="+90">🇹🇷 +90</option>
                            <option value="+49">🇩🇪 +49</option>
                            <option value="+33">🇫🇷 +33</option>
                            <option value="+39">🇮🇹 +39</option>
                            <option value="+34">🇪🇸 +34</option>
                            <option value="+31">🇳🇱 +31</option>
                            <option value="+46">🇸🇪 +46</option>
                            <option value="+47">🇳🇴 +47</option>
                            <option value="+45">🇩🇰 +45</option>
                            <option value="+358">🇫🇮 +358</option>
                            <option value="+61">🇦🇺 +61</option>
                            <option value="+81">🇯🇵 +81</option>
                            <option value="+86">🇨🇳 +86</option>
                            <option value="+82">🇰🇷 +82</option>
                            <option value="+55">🇧🇷 +55</option>
                            <option value="+52">🇲🇽 +52</option>
                            <option value="+7">🇷🇺 +7</option>
                            <option value="+971">🇦🇪 +971</option>
                        </select>
                        <input type="text" x-model="number" @input="number = formatNum($event.target.value)" placeholder="532 123 45 67" class="flex-1 rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" :class="{ 'border-red-300': @json($errors->has('phone')) }">
                        <input type="hidden" name="phone" :value="code + ' ' + number">
                    </div>
                    @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea name="address" id="address" rows="3" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('address') border-red-300 @enderror">{{ old('address', Auth::user()->address) }}</textarea>
                    @error('address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Save Changes</button>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-4">
                <h3 class="text-base font-semibold text-gray-900">Payment Method</h3>
                <p class="text-xs text-gray-400">This is a mock shop — no real payment info is stored or processed.</p>

                <div>
                    <label for="card_nickname" class="block text-sm font-medium text-gray-700 mb-1">Card Nickname</label>
                    <input type="text" name="card_nickname" id="card_nickname" value="{{ old('card_nickname', Auth::user()->card_nickname) }}" placeholder="e.g. Visa, Mastercard" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('card_nickname') border-red-300 @enderror">
                    @error('card_nickname') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="card_last_four" class="block text-sm font-medium text-gray-700 mb-1">Last 4 Digits</label>
                        <input type="text" name="card_last_four" id="card_last_four" value="{{ old('card_last_four', Auth::user()->card_last_four) }}" placeholder="4242" maxlength="4" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('card_last_four') border-red-300 @enderror">
                        @error('card_last_four') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div x-data="{
                        month: '{{ old('card_expiry', Auth::user()->card_expiry) ? explode('/', Auth::user()->card_expiry)[0] : '' }}',
                        year: '{{ old('card_expiry', Auth::user()->card_expiry) ? explode('/', Auth::user()->card_expiry)[1] : '' }}'
                    }">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Expiry</label>
                        <div class="flex space-x-2">
                            <select x-model="month" @change="$el.closest('div').parentElement.querySelector('[name=card_expiry]').value = month && year ? month + '/' + year : ''" class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" :class="{ 'border-red-300': @json($errors->has('card_expiry')) }">
                                <option value="">MM</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                            <span class="text-gray-400 self-center">/</span>
                            <select x-model="year" @change="$el.closest('div').parentElement.querySelector('[name=card_expiry]').value = month && year ? month + '/' + year : ''" class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" :class="{ 'border-red-300': @json($errors->has('card_expiry')) }">
                                <option value="">YY</option>
                                @for ($y = (int) date('y'); $y <= (int) date('y') + 10; $y++)
                                    <option value="{{ str_pad($y, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($y, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                            <input type="hidden" name="card_expiry" :value="month && year ? month + '/' + year : ''">
                        </div>
                        @error('card_expiry') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Save Changes</button>
                </div>
            </div>
        </form>

        <form method="POST" action="{{ route('user.profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-4">
                <h3 class="text-base font-semibold text-gray-900">Change Password</h3>

                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('current_password') border-red-300 @enderror">
                    @error('current_password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="password" id="password" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-300 @enderror">
                    @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Update Password</button>
                </div>
            </div>
        </form>
    </div>
@endsection
