import { Head } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
// import { label } from '@/components/ui/label';
import { dashboard } from '@/routes';
import { useForm } from '@inertiajs/react';

export default function Dashboard() {
    const form = useForm({ name: '', price: '', description: '' });

    function submit(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        form.post('/product', {
            onSuccess: () => form.reset(),
        });

    }


    return (
        <>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div>
                    <h1 className="text-xl font-semibold">Products</h1>
                    <p className="text-muted-foreground text-sm">
                        add new product
                    </p>
                </div>

                <form onSubmit={submit} className="max-w-x1 space-y-4 rounded-lg border p-4">
                    <div className="space-y-2">
                        <label htmlFor="name">Name:</label>
                        <Input
                            id="name"
                            value={form.data.name}
                            onChange={(event) => form.setData('name', event.target.value)}
                        />
                        {form.errors.name && <p className="text-sm text-red-600">{form.errors.name}</p>}
                    </div>

                    <div className="space-y-2">
                        <label htmlFor="description">Description:</label>

                        <Input
                            id="description"
                            value={form.data.description}
                            onChange={(event) => form.setData('description', event.target.value)}
                        />
                    </div>

                    <div className="space-y-2">
                        <label htmlFor="price">Price:</label>

                        <Input
                            id="price"
                            value={form.data.price}
                            onChange={(event) => form.setData('price', event.target.value)}
                        />
                        {form.errors.price && <p className="text-sm text-red-600">{form.errors.price}</p>}
                    </div>
                    <Button type="submit" disabled={form.processing}>
                        Save Product
                    </Button>
                </form>


            </div>
        </>
    );
}

Dashboard.layout = {
    breadcrumbs: [
        {
            title: 'Dashboard',
            href: dashboard(),
        },
    ],
};
