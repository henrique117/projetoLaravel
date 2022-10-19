<div>
   <form method="post" wire:submit.prevent="store">
       <p>{{$title}}</p>
       <p>{{$body}}</p>
        <div class="bg-red-400">
            @error('title') <p>{{$message}}</p> @enderror
            @error('body') <p>{{$message}}</p> @enderror
        </div>
        <input type= "hidden" name ="editId"  wire:model="editId" />
        <input type= "text" name ="title"  wire:model="title" class="w-full rounded-lg"/><br/>
        <textarea name="body" wire:model="body" class="w-full rounded-lg"></textarea><br/>
        <button type="submit" class="bg-primary rounded-lg p-2">Enviar</button>
        <button type="button" class="bg-secondary rounded-lg p-2" wire:click="limpar()">Limpar</button>
    </form>
        <div class="flex">
            <div class="w-full">
            <table class="w-full">
                <thead>
                    <tr class="border">
                        <th>Título</th>
                        <th>Corpo</th>
                        <th>Editar</th>
                        <th>Remover</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($avisos as $aviso)
                    <tr class="border">
                        <td>{{$aviso->title}}</td>
                        <td>{{$aviso->body}}</td>
                        <td><button type="button" class="bg-blue-500 rounded-lg p-1" wire:click="edit({{$aviso->id}})">Editar</button></td>
                        <td><button type="button" class="bg-red-500 rounded-lg p-1" wire:click="destroy({{$aviso->id}})">Remover</button></td>
                        <td><input type="checkbox" wire:model="avisoId" value="{{$aviso->id}}"/> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{$avisos->links()}}
            </div>
            </div>
            <div class="w-full">
                <table clss="w-full">
                    <thead>
                        <tr class="border">
                            <th>Nome</th>
                            <th>Token</th>
                            <th>Envio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="border">
                            <td>{{$user->name}}</td>
                            <td>{{$user->token}}</td>
                            <td><input type="checkbox" wire:model="userId" value="{{$user->id}}" /></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$users->links()}}
                </div>
            </div>
        </div>

    <div clss="bg-red-400 text-white">
        <p>{{$avisoUserMessage}}</p>
    </div>
    <button type="button" class="bg-secondary rounded-lg p-2" wire:click="avisoUser()">Enviar Mensagem</button>
</div>