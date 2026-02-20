<x-layouts.app :title="__('Dashboard')">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div>
            <h1 class="mb-2 text-4xl font-bold text-heading md:text-4xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">{{ __("Dashboard") }}</span>
            </h1>
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ url('/dashboard', []) }}" icon="home">Home</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Dashboard</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>

        <div>
           <flux:input icon="magnifying-glass" placeholder="Search orders" />
        </div>
        
    </div>

    <flux:separator variant="subtle" class="my-4"/>

    
    <flux:button variant='primary' size='sm' color='zinc'>Zinc</flux:button>
    <flux:button variant='primary' size='sm' color='red'>Red</flux:button>
    <flux:button variant='primary' size='sm' color='green'>Green</flux:button>
    <flux:button variant='primary' size='sm' color='yellow'>Yellow</flux:button>
    <flux:button variant='primary' size='sm' color='sky'>Sky</flux:button>
    <flux:button variant='primary' size='sm' color='blue'>Blue</flux:button>
    <flux:button variant='primary' size='sm' color='rose'>Rose</flux:button>

    <flux:table>
        <flux:table.columns >
            <flux:table.column>Customer</flux:table.column>
            <flux:table.column>Date</flux:table.column>
            <flux:table.column>Date</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column>Amount</flux:table.column>
        </flux:table.columns>
    
        <flux:table.rows>
            <flux:table.row>
                <flux:table.cell>Lindsey Aminoff</flux:table.cell>
                <flux:table.cell>Jul 29, 10:45 AM</flux:table.cell>
                <flux:table.cell><flux:badge color='green' size='sm' inset='top bottom'>Paid</flux:badge></flux:table.cell>
                <flux:table.cell variant='strong'>$49.00</flux:table.cell>
            </flux:table.row>
        </flux:table.rows>
    </flux:table>
</x-layouts.app>
