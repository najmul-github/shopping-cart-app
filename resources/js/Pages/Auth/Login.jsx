import React, { useEffect } from 'react';
import Button from '@/Components/Button';
import Checkbox from '@/Components/checkbox';
import Guest from '@/Layouts/guest';
import Input from '@/Components/input';
import Label from '@/Components/label';
import ValidationErrors from '@/Components/validationErrors';
import { Head, Link, useForm } from '@inertiajs/inertia-react';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const onHandleChange = (event) => {
        const value = event.target.type === 'checkbox' ? event.target.checked : event.target.value;
        setData(event.target.name, value);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route('login'));
    };

    return (
        <Guest>
            <Head title="Log in" />
            <div className="flex justify-center items-center min-h-screen bg-gray-100">
                <div className="max-w-md w-full px-6 py-8 bg-white shadow-md rounded-lg">
                    <h2 className="text-2xl font-semibold text-center mb-6">Log in</h2>

                    {status && <div className="text-green-600 mb-4 text-center">{status}</div>}

                    <ValidationErrors errors={errors} />

                    <form onSubmit={submit}>
                        <div className="mb-4">
                            <Label forInput="email" value="Email" />
                            <Input
                                type="email"
                                name="email"
                                value={data.email}
                                className="form-control mt-1 block w-full"
                                autoComplete="username"
                                onChange={onHandleChange}
                            />
                        </div>

                        <div className="mb-4">
                            <Label forInput="password" value="Password" />
                            <Input
                                type="password"
                                name="password"
                                value={data.password}
                                className="mt-1 block w-full"
                                autoComplete="current-password"
                                onChange={onHandleChange}
                            />
                        </div>

                        <div className="mb-4">
                            <Checkbox
                                name="remember"
                                value={data.remember}
                                handleChange={onHandleChange}
                            />
                            <Label forInput="remember" value="Remember me" />
                        </div>

                        <div className="flex items-center justify-between">
                            {canResetPassword && (
                                <Link
                                    href={route('password.request')}
                                    className="text-sm text-gray-600 hover:text-gray-900"
                                >
                                    Forgot your password?
                                </Link>
                            )}

                            <Button className="ml-4" processing={processing}>
                                Log in
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </Guest>
    );
}
