<div>
    <h1>Hello World!</h1>
        {{-- <button wire:click="increment">+</button>
        <button wire:click="m">-</button>
        <h1>{{ $count }}</h1>  --}}

    {{-- <input wire:model="search" type="text" placeholder="Search users..."/>

    <ul>
        @forelse ($users as $user)
        
        <li>{{ $user->name }}</li>
        @empty
        @endforelse
       
    </ul> --}}
    <form wire:submit.prevent="saveContact">
        <input type="text" wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror
     <br><br>
        <input type="text" wire:model="email">
        @error('email') <span class="error">{{ $message }}</span> @enderror
        <br>
        <button type="submit">Save Contact</button>
        
    </form>

</div>
