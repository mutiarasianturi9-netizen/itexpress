@include ('admin.navigation')
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">
            Detail User
        </h1>

        <div class="bg-white rounded-2xl shadow p-6 space-y-4">

            <div>
                <p class="text-gray-500 text-sm">Nama</p>
                <p class="font-semibold">{{ $user->name }}</p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Email</p>
                <p class="font-semibold">{{ $user->email }}</p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Status</p>
                <p class="font-semibold">
                    {{ $user->status }}
                </p>
            </div>

        </div>

    </div>