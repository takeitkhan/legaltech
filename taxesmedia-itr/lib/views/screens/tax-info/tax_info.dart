import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/screens/tax-info/bank_info.dart';
import 'package:itr/views/screens/tax-info/income_sources.dart';
import 'package:itr/views/screens/tax-info/personal_info.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class TaxInfoScreen extends HookWidget {
  const TaxInfoScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final currentTab = useState(0);

    final controller = useTabController(initialLength: 3);

    final tabs = [
      PersonalInfoTab(onComplete: () => currentTab.value++),
      IncomeSourcesTab(onComplete: () => currentTab.value++),
      BankInfoTab(onComplete: () {
        Navigator.pushNamed(context, Routes.result);
      }),
    ];
    return GradientScaffold(
      appBar: TransparentAppBar(
        title: AppLocalizations.of(context)!.tax_information,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            TabBar(
              controller: controller,
              labelPadding: const EdgeInsets.only(right: 10),
              isScrollable: true,
              indicator: const BoxDecoration(),
              overlayColor: MaterialStateProperty.resolveWith(
                (states) => Colors.transparent,
              ),
              onTap: (index) {
                if (index < currentTab.value) {
                  currentTab.value = index;
                }
              },
              tabs: [
                Tab(
                  child: Container(
                    padding: const EdgeInsets.symmetric(
                      horizontal: 12,
                      vertical: 8,
                    ),
                    decoration: BoxDecoration(
                      color: currentTab.value == 0
                          ? Theme.of(context).colorScheme.primary
                          : Theme.of(context).colorScheme.secondary,
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: Text(
                      AppLocalizations.of(context)!.personal_info,
                      style: Theme.of(context).textTheme.titleLarge?.copyWith(
                            color: currentTab.value == 0 ? Colors.white : null,
                          ),
                    ),
                  ),
                ),
                Tab(
                  child: Container(
                    padding: const EdgeInsets.symmetric(
                      horizontal: 12,
                      vertical: 8,
                    ),
                    decoration: BoxDecoration(
                      color: currentTab.value == 1
                          ? Theme.of(context).colorScheme.primary
                          : Theme.of(context).colorScheme.secondary,
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: Text(
                      AppLocalizations.of(context)!.income_sources,
                      style: Theme.of(context).textTheme.titleLarge?.copyWith(
                            color: currentTab.value == 1 ? Colors.white : null,
                          ),
                    ),
                  ),
                ),
                Tab(
                  child: Container(
                    padding: const EdgeInsets.symmetric(
                      horizontal: 12,
                      vertical: 8,
                    ),
                    decoration: BoxDecoration(
                      color: currentTab.value == 2
                          ? Theme.of(context).colorScheme.primary
                          : Theme.of(context).colorScheme.secondary,
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: Text(
                      AppLocalizations.of(context)!.bank_info,
                      style: Theme.of(context).textTheme.titleLarge?.copyWith(
                            color: currentTab.value == 2 ? Colors.white : null,
                          ),
                    ),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 24),
            Expanded(child: tabs[currentTab.value]),
          ],
        ),
      ),
    );
  }
}
