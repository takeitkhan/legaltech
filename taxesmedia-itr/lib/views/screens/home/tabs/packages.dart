import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/core/models/package.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';
import 'package:themed/themed.dart';

class PackagesTab extends HookWidget {
  const PackagesTab({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final selectedCategory = useState('individual');

    final packages = [
      Package(
        title: 'Do It Yourself',
        description: 'Only for downloading PDF',
        category: 'individual',
        price: 100,
        vat: 5,
        benefits: [
          "Complete your return by quick & easy step-by-step process.",
          "Receive 100% accurate & automatic tax calculation.",
          "Get unlimited data revisions & unlimited PDF (tax return file) downloads.",
          "Review tax return by Income tax specialists.",
          "Get easy download & print.",
          "Submit tax return at your local NBR office.",
        ],
      ),
      Package(
        title: 'Hire Expert',
        description: 'For submitting the form',
        category: 'individual',
        price: 200,
        vat: 10,
        benefits: [
          "Complete your return by quick & easy step-by-step process.",
          "Receive 100% accurate & automatic tax calculation.",
          "Get unlimited data revisions & unlimited PDF (tax return file) downloads.",
          "Review tax return by Income tax specialists.",
          "Get easy download & print.",
          "Submit tax return at your local NBR office.",
        ],
      ),
      Package(
        title: 'Talk to Expert',
        description: 'Our expert will do everything to help you.',
        category: 'expert',
        price: 300,
        vat: 15,
        benefits: [
          "Complete your return by quick & easy step-by-step process.",
          "Receive 100% accurate & automatic tax calculation.",
          "Get unlimited data revisions & unlimited PDF (tax return file) downloads.",
          "Review tax return by Income tax specialists.",
          "Get easy download & print.",
          "Submit tax return at your local NBR office.",
        ],
      ),
    ];

    return GradientScaffold(
      appBar: TransparentAppBar(
        showDefaultLeading: false,
        title: AppLocalizations.of(context)!.packages,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            Row(
              children: [
                ChoiceChip(
                  selected:
                      selectedCategory.value == 'individual' ? true : false,
                  label: Text(
                    AppLocalizations.of(context)!.for_individuals,
                  ),
                  labelStyle: Theme.of(context).textTheme.titleLarge?.copyWith(
                        color: selectedCategory.value == 'individual'
                            ? Colors.white
                            : null,
                      ),
                  labelPadding: const EdgeInsets.symmetric(
                    horizontal: 8,
                    vertical: 4,
                  ),
                  selectedColor: Theme.of(context).colorScheme.primary,
                  backgroundColor:
                      Theme.of(context).colorScheme.primary.withOpacity(0.3),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                  pressElevation: 0,
                  onSelected: (value) {
                    selectedCategory.value = 'individual';
                  },
                ),
                const SizedBox(width: 10),
                ChoiceChip(
                  selected: selectedCategory.value == 'expert' ? true : false,
                  label: Text(
                    AppLocalizations.of(context)!.expert_guidance,
                  ),
                  labelStyle: Theme.of(context).textTheme.titleLarge?.copyWith(
                        color: selectedCategory.value == 'expert'
                            ? Colors.white
                            : null,
                      ),
                  labelPadding: const EdgeInsets.symmetric(
                    horizontal: 8,
                    vertical: 4,
                  ),
                  selectedColor: Theme.of(context).colorScheme.primary,
                  backgroundColor:
                      Theme.of(context).colorScheme.primary.withOpacity(0.3),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                  pressElevation: 0,
                  onSelected: (value) {
                    if (value) selectedCategory.value = 'expert';
                  },
                ),
              ],
            ),
            const SizedBox(height: 20),
            Expanded(
              child: ListView.separated(
                itemCount: packages
                    .where(
                      (package) => package.category == selectedCategory.value,
                    )
                    .length,
                itemBuilder: (context, index) => PackageCard(
                  package: packages
                      .where(
                        (package) => package.category == selectedCategory.value,
                      )
                      .toList()[index],
                  hue: (index * -0.7),
                ),
                separatorBuilder: (context, index) => const SizedBox(
                  height: 20,
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class PackageCard extends StatelessWidget {
  const PackageCard({
    Key? key,
    required this.package,
    required this.hue,
  }) : super(key: key);

  final Package package;
  final double hue;

  @override
  Widget build(BuildContext context) {
    return Stack(
      alignment: Alignment.centerLeft,
      children: [
        ChangeColors(
          hue: hue,
          child: Image.asset(
            'assets/images/package-bg.png',
          ),
        ),
        Padding(
          padding: const EdgeInsets.symmetric(
            horizontal: 16,
            vertical: 32,
          ),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.end,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Container(
                padding: const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: Colors.black,
                  borderRadius: BorderRadius.circular(12),
                ),
                child: Text(
                  'Save 40%',
                  style: Theme.of(context).textTheme.bodySmall?.copyWith(
                        color: Colors.white,
                      ),
                ),
              ),
              const SizedBox(height: 8),
              Text(
                package.title,
                style: Theme.of(context).textTheme.headline5?.copyWith(
                      color: Colors.black,
                      fontWeight: FontWeight.w600,
                    ),
              ),
              const SizedBox(height: 5),
              Text(
                package.description,
                style: Theme.of(context).textTheme.labelMedium,
              ),
              const SizedBox(height: 8),
              Text(
                '\$${package.price.toStringAsFixed(0)}',
                style: Theme.of(context).textTheme.headline4?.copyWith(
                      color: Colors.black,
                      fontWeight: FontWeight.bold,
                    ),
              ),
              const SizedBox(height: 16),
              GestureDetector(
                onTap: () {
                  Navigator.pushNamed(
                    context,
                    Routes.packageDetails,
                    arguments: package,
                  );
                },
                child: Container(
                  padding: const EdgeInsets.symmetric(
                    vertical: 10,
                    horizontal: 16,
                  ),
                  decoration: BoxDecoration(
                    color:
                        Theme.of(context).colorScheme.primary.withOpacity(0.2),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Row(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Text(
                        'See More',
                        style: Theme.of(context).textTheme.titleLarge?.copyWith(
                              color: Theme.of(context).colorScheme.primary,
                            ),
                      ),
                      const SizedBox(width: 5),
                      Icon(
                        Icons.arrow_forward,
                        size: 16,
                        color: Theme.of(context).colorScheme.primary,
                      ),
                    ],
                  ),
                ),
              )
            ],
          ),
        ),
        Positioned(
          bottom: 50,
          right: 40,
          child: Image.asset(
            'assets/images/safe-coins.png',
            width: 75,
          ),
        ),
      ],
    );
  }
}
