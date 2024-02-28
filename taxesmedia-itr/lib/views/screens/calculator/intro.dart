import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/primary_button.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class CalculatorIntroScreen extends HookWidget {
  const CalculatorIntroScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final ValueNotifier<String?> financialYear = useState(null);
    final ValueNotifier<String?> age = useState('0-60');

    return GradientScaffold(
      appBar: TransparentAppBar(
        title: AppLocalizations.of(context)!.income_tax_calculator,
      ),
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                AppLocalizations.of(context)!.latest_budget_message,
                style: Theme.of(context).textTheme.titleMedium,
              ),
              const SizedBox(height: 24),
              Text(
                AppLocalizations.of(context)!.which_financial_year,
                style: Theme.of(context).textTheme.headline5?.copyWith(
                      fontWeight: FontWeight.bold,
                    ),
              ),
              const SizedBox(height: 12),
              GestureDetector(
                onTap: () => financialYear.value = '2022-2023',
                child: Row(
                  children: [
                    Container(
                      width: 22,
                      height: 22,
                      padding: const EdgeInsets.all(3),
                      decoration: BoxDecoration(
                        border: Border.all(
                          color: Theme.of(context).colorScheme.primary,
                          width: 2,
                        ),
                        borderRadius: BorderRadius.circular(6),
                      ),
                      child: financialYear.value == '2022-2023'
                          ? Container(
                              decoration: BoxDecoration(
                                color: Theme.of(context).colorScheme.primary,
                                borderRadius: BorderRadius.circular(3),
                              ),
                            )
                          : null,
                    ),
                    const SizedBox(width: 12),
                    Flexible(
                      child: Text(
                        AppLocalizations.of(context)!.fy_2022_2023,
                        style: Theme.of(context).textTheme.titleMedium,
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 16),
              GestureDetector(
                onTap: () => financialYear.value = '2021-2022',
                child: Row(
                  children: [
                    Container(
                      width: 22,
                      height: 22,
                      padding: const EdgeInsets.all(3),
                      decoration: BoxDecoration(
                        border: Border.all(
                          color: Theme.of(context).colorScheme.primary,
                          width: 2,
                        ),
                        borderRadius: BorderRadius.circular(6),
                      ),
                      child: financialYear.value == '2021-2022'
                          ? Container(
                              decoration: BoxDecoration(
                                color: Theme.of(context).colorScheme.primary,
                                borderRadius: BorderRadius.circular(3),
                              ),
                            )
                          : null,
                    ),
                    const SizedBox(width: 12),
                    Flexible(
                      child: Text(
                        AppLocalizations.of(context)!.fy_2021_2022,
                        style: Theme.of(context).textTheme.titleMedium,
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 24),
              Text(
                AppLocalizations.of(context)!.your_age,
                style: Theme.of(context).textTheme.headline5?.copyWith(
                      fontWeight: FontWeight.bold,
                    ),
              ),
              const SizedBox(height: 12),
              GestureDetector(
                onTap: () => age.value = '0-60',
                child: Row(
                  children: [
                    Container(
                      width: 22,
                      height: 22,
                      padding: const EdgeInsets.all(3),
                      decoration: BoxDecoration(
                        border: Border.all(
                          color: Theme.of(context).colorScheme.primary,
                          width: 2,
                        ),
                        borderRadius: BorderRadius.circular(6),
                      ),
                      child: age.value == '0-60'
                          ? Container(
                              decoration: BoxDecoration(
                                color: Theme.of(context).colorScheme.primary,
                                borderRadius: BorderRadius.circular(3),
                              ),
                            )
                          : null,
                    ),
                    const SizedBox(width: 12),
                    Flexible(
                      child: Text(
                        AppLocalizations.of(context)!.age_0_to_60,
                        style: Theme.of(context).textTheme.titleMedium,
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 16),
              GestureDetector(
                onTap: () => age.value = '60-80',
                child: Row(
                  children: [
                    Container(
                      width: 22,
                      height: 22,
                      padding: const EdgeInsets.all(3),
                      decoration: BoxDecoration(
                        border: Border.all(
                          color: Theme.of(context).colorScheme.primary,
                          width: 2,
                        ),
                        borderRadius: BorderRadius.circular(6),
                      ),
                      child: age.value == '60-80'
                          ? Container(
                              decoration: BoxDecoration(
                                color: Theme.of(context).colorScheme.primary,
                                borderRadius: BorderRadius.circular(3),
                              ),
                            )
                          : null,
                    ),
                    const SizedBox(width: 12),
                    Flexible(
                      child: Text(
                        AppLocalizations.of(context)!.age_60_to_80,
                        style: Theme.of(context).textTheme.titleMedium,
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 16),
              GestureDetector(
                onTap: () => age.value = '80+',
                child: Row(
                  children: [
                    Container(
                      width: 22,
                      height: 22,
                      padding: const EdgeInsets.all(3),
                      decoration: BoxDecoration(
                        border: Border.all(
                          color: Theme.of(context).colorScheme.primary,
                          width: 2,
                        ),
                        borderRadius: BorderRadius.circular(6),
                      ),
                      child: age.value == '80+'
                          ? Container(
                              decoration: BoxDecoration(
                                color: Theme.of(context).colorScheme.primary,
                                borderRadius: BorderRadius.circular(3),
                              ),
                            )
                          : null,
                    ),
                    const SizedBox(width: 12),
                    Flexible(
                      child: Text(
                        AppLocalizations.of(context)!.age_80_above,
                        style: Theme.of(context).textTheme.titleMedium,
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 24),
              const Spacer(),
              PrimaryButton(
                onTap: () => Navigator.pushNamed(
                  context,
                  Routes.calculatorForm,
                ),
                text: AppLocalizations.of(context)!.next,
              ),
            ],
          ),
        ),
      ),
    );
  }
}
