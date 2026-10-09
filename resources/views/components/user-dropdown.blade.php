    <div class="relative">

        <button onclick="toggleDropdown()"
            class="flex items-center gap-2 text-[#123c2f] font-medium">

            {{ Auth::user()->name }}

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7" />

            </svg>

        </button>

        <!-- DROPDOWN -->
        <div id="dropdownMenu"
            class="hidden absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg py-2">

            <a href="{{ route('profile.edit') }}"
                class="block px-4 py-2 hover:bg-gray-100">
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full text-left px-4 py-2 hover:bg-gray-100">
                    Logout
                </button>
            </form>

        </div>

    </div>
<script>
    function toggleDropdown() {
        document.getElementById('dropdownMenu')
            .classList.toggle('hidden');
    }
</script>