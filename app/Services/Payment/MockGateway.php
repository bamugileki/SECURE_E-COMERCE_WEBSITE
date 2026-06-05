<?php

namespace App\Services\Payment;

class MockGateway implements PaymentGatewayInterface
{
    public function getName(): string
    {
        return 'mock';
    }

    public function getDisplayName(): string
    {
        return 'Mock Payment (Test)';
    }

    public function checkout(array $params): array
    {
        $reference = 'mock_' . uniqid();
        $total = collect($params['items'])->sum(fn($i) => $i['price'] * $i['quantity']);

        session()->put("mock_payment.{$reference}", [
            'status' => 'pending',
            'amount' => $total,
            'currency' => $params['currency'] ?? 'TZS',
            'user_id' => $params['user_id'],
            'items' => $params['items'],
        ]);

        return [
            'status' => 'redirect',
            'redirect_url' => route('payment.mock.confirm', ['reference' => $reference]),
            'gateway_reference' => $reference,
            'gateway_data' => [
                'reference' => $reference,
            ],
        ];
    }

    public function complete(array $data): array
    {
        $reference = $data['mock_reference'] ?? $data['reference'] ?? null;

        if (!$reference) {
            return ['status' => 'failed', 'message' => 'Missing mock reference.'];
        }

        $paymentData = session()->get("mock_payment.{$reference}");

        if (!$paymentData) {
            return ['status' => 'failed', 'message' => 'Invalid mock payment reference.'];
        }

        $paymentData['status'] = 'completed';
        session()->put("mock_payment.{$reference}", $paymentData);

        return [
            'status' => 'completed',
            'gateway_reference' => $reference,
            'gateway_data' => $paymentData,
            'amount' => $paymentData['amount'],
            'currency' => $paymentData['currency'],
        ];
    }

    public function verify(string $reference): array
    {
        $paymentData = session()->get("mock_payment.{$reference}");

        if (!$paymentData) {
            return ['status' => 'failed', 'message' => 'Reference not found.'];
        }

        return [
            'status' => $paymentData['status'],
            'gateway_reference' => $reference,
            'gateway_data' => $paymentData,
            'amount' => $paymentData['amount'],
            'currency' => $paymentData['currency'],
        ];
    }
}
