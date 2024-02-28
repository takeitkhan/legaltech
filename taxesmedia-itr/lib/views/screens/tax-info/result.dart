import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:hooks_riverpod/hooks_riverpod.dart';
import 'package:itr/core/controllers/tax_calculator.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/primary_button.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class ResultScreen extends HookConsumerWidget {
  const ResultScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    late double tax;
    useEffect(() {
      tax = ref.read(taxCalculatorProvider).calculateTax();
      return null;
    }, []);

    return GradientScaffold(
      appBar: TransparentAppBar(
        title: AppLocalizations.of(context)!.result,
      ),
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            children: [
              Image.asset(
                'assets/images/filing-result.png',
                height: 260,
              ),
              const SizedBox(height: 24),
              Text(
                AppLocalizations.of(context)!.congratulations,
                style: Theme.of(context).textTheme.headline5?.copyWith(
                      color: Theme.of(context).colorScheme.primary,
                      fontWeight: FontWeight.w600,
                    ),
              ),
              const SizedBox(height: 12),
              Text(
                AppLocalizations.of(context)!.result_text(tax),
                style: Theme.of(context)
                    .textTheme
                    .titleMedium
                    ?.copyWith(height: 1.5),
                textAlign: TextAlign.center,
              ),
              const Spacer(),
              const SizedBox(height: 24),
              PrimaryButton(
                onTap: () {},
                text: AppLocalizations.of(context)!.download_11ga_form,
              ),
            ],
          ),
        ),
      ),
    );
  }
}
